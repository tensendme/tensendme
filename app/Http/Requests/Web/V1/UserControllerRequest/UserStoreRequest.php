<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.03.2020
 * Time: 23:48
 */

namespace App\Http\Requests\Web\V1\UserControllerRequest;


use App\Http\Requests\WebBaseRequest;

class UserStoreRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'email' => ['email', 'required', 'unique:users,email'],
            'phone' => ['numeric', 'required', 'unique:users,phone'],
            'level_id' => ['numeric', 'required', 'exists:levels,id'],
            'city_id' => ['numeric', 'required', 'exists:cities,id'],
            'role_id' => ['numeric', 'required', 'exists:roles,id'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'father_name' => ['nullable'],
            'password' => ['required', 'string'],
            'image_path' => ['nullable', 'image'],
        ];
    }

}