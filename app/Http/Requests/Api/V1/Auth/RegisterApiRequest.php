<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class RegisterApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        if (request()->has('email')) {
            return [
                'email' => ['email', 'string', 'unique:users', 'required'],
                'password' => ['string', 'min:8'],
            ];
        } else {
            return [
                'phone' => ['string', 'unique:users', 'required'],
                'password' => ['string', 'min:8'],
            ];
        }
    }

}
