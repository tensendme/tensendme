<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class LoginApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

}
