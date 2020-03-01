<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\UserControllerRequest\UserRequest;
use App\Models\Profiles\Role;
use App\Models\Profiles\User;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\FileService;
use Illuminate\Http\Request;

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
                case Role::AUTHOR_ID: $roleName = 'Автор'; break;
                case Role::ACCOUNTANT_ID: $roleName = 'Бухгалтер'; break;
                case Role::USER_ID: $roleName = 'Пользователь'; break;
                case Role::ADMIN_ID: $roleName = 'Админ'; break;
                case Role::SUPER_ADMIN_ID: $roleName = 'Супер Админ'; break;
                case Role::CONTENT_MANAGER_ID: $roleName = 'Контент Менеджер'; break;
            }
            $user->role->name = $roleName;
        }
        return view('admin.users.index', compact('users'));
    }

    public function authors(Request $request) {
        $phone = $request->term;
        if(!$phone)
        $authors = User::where('role_id', Role::AUTHOR_ID)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        else $authors = User::where('role_id', Role::AUTHOR_ID)->where('phone', 'like', '%' .$phone. '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $authors;
    }

    public function changeRole($id) {
        $user = User::find($id);
        $roles = Role::all();
        foreach ($roles as $role) {
            $roleName = '';
            switch ($role->id) {
                case Role::AUTHOR_ID: $roleName = 'Автор'; break;
                case Role::ACCOUNTANT_ID: $roleName = 'Бухгалтер'; break;
                case Role::USER_ID: $roleName = 'Пользователь'; break;
                case Role::ADMIN_ID: $roleName = 'Админ'; break;
                case Role::SUPER_ADMIN_ID: $roleName = 'Супер Админ'; break;
                case Role::CONTENT_MANAGER_ID: $roleName = 'Контент Менеджер'; break;
            }
            $role->name = $roleName;
        }
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateRole($id, UserRequest $request) {
        User::find($id)->update(['role_id' => $request->role_id]);
        $this->edited();
        return redirect()->route('users.index');
    }

    public function subscribe($id) {
        $user = User::find($id);
        $subscriptionTypes = SubscriptionType::all();
        return view('admin.users.subscriptionEdit', compact('user', 'subscriptionTypes'));
    }

}
