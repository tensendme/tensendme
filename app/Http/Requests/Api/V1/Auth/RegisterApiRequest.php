<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class RegisterApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        if (request()->has('email')) {
            return [
                'email' => ['email', 'string', 'unique:users'],
                'password' => ['password', 'string'],
            ];
        } else {
            return [
                'phone' => ['string', 'unique:users'],
                'password' => ['string', 'min:8'],
            ];
        }
    }

}
