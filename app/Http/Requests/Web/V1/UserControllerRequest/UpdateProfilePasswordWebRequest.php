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

class UpdateProfilePasswordWebRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'old_password' => 'required',
        ];
    }

}