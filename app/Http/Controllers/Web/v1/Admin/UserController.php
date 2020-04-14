<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\CloudMessaging\Pushes\GeneralPush;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\UserControllerRequest\UpdateProfilePasswordWebRequest;
use App\Http\Requests\Web\V1\UserControllerRequest\UpdateProfileWebRequest;
use App\Http\Requests\Web\V1\UserControllerRequest\UserRequest;
use App\Http\Requests\Web\V1\UserControllerRequest\UserStoreRequest;
use App\Jobs\SendPush;
use App\JobTemplates\PushJobTemplate;
use App\Models\ModelSorts\BalanceSort;
use App\Models\Profiles\Balance;
use App\Models\Profiles\City;
use App\Models\Profiles\Level;
use App\Models\Profiles\Role;
use App\Models\Profiles\User;
use App\Models\Subscriptions\SubscriptionType;
use App\Queues\QueueConstants;
use App\Services\v1\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Sorts\Sort;

class UserController extends WebBaseController
{

    protected $fileService;

    /**
     * CourseController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function profile()
    {
        $cities = City::all();
        return view('admin.users.profile', compact('cities'));
    }


    public function updateProfilePassword(UpdateProfilePasswordWebRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            $this->edited();
            return redirect()->back();
        }
        throw new WebServiceErroredException('Введенный новый пароль не совпадает с вашим старым!');

    }

    public function updateProfile(UpdateProfileWebRequest $request)
    {
        $user = Auth::user();
        if ($request->file('image')) {
            $user->image_path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'),
                    User::DEFAULT_RESOURCE_DIRECTORY,
                    $user->image_path);
        }

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'phone' => $request->phone,
            'image_path' => $user->image_path,
        ]);

        $this->edited();
        return redirect()->back();
    }

    public function index()
    {

        $users = User::orderBy('created_at', 'desc')->with(['role', 'level', 'city', 'balance'])->paginate(10);
        $roles = Role::all();
        $levels = Level::all();
        $this->switchRole($roles);

        return view('admin.users.index', compact('users', 'roles', 'levels'));
    }

    public function filter(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'surname', 'father_name', 'role_id', 'email',
                'phone', AllowedFilter::exact('level_id'), 'platform', AllowedFilter::scope('register_before'),
                AllowedFilter::scope('register_after')])
            ->defaultSort('-id')
            ->allowedIncludes(['role', 'level', 'city', 'balance'])
            ->allowedSorts('id', 'created_at', 'name', 'surname', 'level_id'
//                ,AllowedSort::custom('balance', new BalanceSort())
    )
            ->paginate($request->perPage);
        $userRoles = $users->pluck('role');
        $this->switchRole($userRoles);

        return view('admin.users.table', compact('users'));
    }

    public function authors(Request $request)
    {
        $phone = $request->term;
        if (!$phone)
            $authors = User::where('role_id', Role::AUTHOR_ID)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        else $authors = User::where('role_id', Role::AUTHOR_ID)->where('phone', 'like', '%' . $phone . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $authors;
    }

    public function change($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update($id, UserRequest $request)
    {
        $user = User::findOrFail($id);
        if ($request->file('image')) {
            $user->image_path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'),
                    User::DEFAULT_RESOURCE_DIRECTORY,
                    $user->image_path);
        }

        $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'phone' => $request->phone,
            'image_path' => $user->image_path,
        ]);

        $this->edited();
        return redirect()->route('users.index');
    }

    public function subscribe($id)
    {
        $user = User::find($id);
        $subscriptionTypes = SubscriptionType::all();
        return view('admin.users.subscriptionEdit', compact('user', 'subscriptionTypes'));
    }

    public function create()
    {
        $roles = Role::all();
        $cities = City::all();
        $levels = Level::all();
        $this->switchRole($roles);
        return view('admin.users.create', compact('levels', 'cities', 'roles'));
    }

    public function sendPush($id, Request $request)
    {
        $user = User::findOrFail($id);
        $generalPush = new GeneralPush($request->title, $request->description);
        $pushJobTemplate = new PushJobTemplate($user, $generalPush);
        SendPush::dispatch($pushJobTemplate)->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
        return response()->json(['message' => 'send']);
    }

    public function store(UserStoreRequest $request)
    {
        $user = new User();
        DB::beginTransaction();
        try {
            $user->fill($request->all());
            if ($request->file('image_path')) {
                $user->image_path = $this->fileService->store($request->file('image_path'), User::DEFAULT_RESOURCE_DIRECTORY);
            } else {
                $user->image_path = null;
            }
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->current_token = '';
            $user->save();

            $balance = new Balance();
            $balance->user_id = $user->id;
            $balance->balance = 0;
            $user->promo_code = $user->promoCode();
            $balance->save();

            $this->added();
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($user->image_path) {
                $this->fileService->remove($user->image_path);
            }
            $this->error();
            return redirect()->back();
        }

    }

    private function switchRole($roles) {
        foreach ($roles as $role) {
            $roleName = '';
            switch ($role->id) {
                case Role::AUTHOR_ID:
                    $roleName = 'Автор';
                    break;
                case Role::ACCOUNTANT_ID:
                    $roleName = 'Бухгалтер';
                    break;
                case Role::USER_ID:
                    $roleName = 'Пользователь';
                    break;
                case Role::ADMIN_ID:
                    $roleName = 'Админ';
                    break;
                case Role::SUPER_ADMIN_ID:
                    $roleName = 'Супер Админ';
                    break;
                case Role::CONTENT_MANAGER_ID:
                    $roleName = 'Контент Менеджер';
                    break;
            }
            $role->name = $roleName;
        }
    }


}
