<?php

namespace App\Http\Requests\Web\V1\UserControllerRequest;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'email' => ['email', 'required', 'unique:users,email'],
            'phone' => ['numeric', 'required', 'unique:users,phone'],
            'role_id' => ['numeric', 'required', 'exists:roles,id'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'father_name' => ['nullable'],
            'image' => ['nullable', 'image'],
        ];
    }
}
