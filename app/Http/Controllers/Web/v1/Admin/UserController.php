<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\UserControllerRequest\UserRequest;
use App\Http\Requests\Web\V1\UserControllerRequest\UserStoreRequest;
use App\Models\Profiles\Balance;
use App\Models\Profiles\City;
use App\Models\Profiles\Level;
use App\Models\Profiles\Role;
use App\Models\Profiles\User;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->with(['role', 'level', 'city', 'balance'])->paginate(10);
        foreach ($users as $user) {
            switch ($user->role->id) {
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
            $user->role->name = $roleName;
        }
        return view('admin.users.index', compact('users'));
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
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update($id, UserRequest $request)
    {
        $user = User::findOrFail($id);
        if ($request->file('image_path')) {
            $user->image_path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image_path'),
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
        return view('admin.users.create', compact('levels', 'cities', 'roles'));
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
            $user->save();

            $balance = new Balance();
            $balance->user_id = $user->id;
            $balance->balance = 0;
            $balance->save();

            $this->added();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($user->image_path) {
                $this->fileService->remove($user->image_path);
            }
            $this->error();
            return redirect()->back();
        }

    }


}
