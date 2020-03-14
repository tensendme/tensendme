<?php

namespace App\Http\Requests\Web\V1\UserControllerRequest;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {

        $id = $this->route('id');
        return [
            'email' => ['email', 'required', 'unique:users,email' . ($id ? ',' . $id : '')],
            'phone' => ['numeric', 'required', 'unique:users,phone' . ($id ? ',' . $id : '')],
            'role_id' => ['numeric', 'required', 'exists:roles,id'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'father_name' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
        ];
    }
}
