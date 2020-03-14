<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14.03.2020
 * Time: 10:49
 */

namespace App\Http\Requests\Web\V1\UserControllerRequest;


use App\Http\Requests\WebBaseRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileWebRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        $id = Auth::id();
        return [
            'email' => ['email', 'required', 'unique:users,email' . ($id ? ',' . $id : '')],
            'phone' => ['numeric', 'required', 'unique:users,phone' . ($id ? ',' . $id : '')],
            'nickname' => ['required', 'unique:users,nickname' . ($id ? ',' . $id : '')],
            'city_id' => ['numeric', 'required', 'exists:cities,id'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'father_name' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
        ];
    }

}