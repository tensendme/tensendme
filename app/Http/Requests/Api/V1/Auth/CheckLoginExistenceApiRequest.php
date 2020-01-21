<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class CheckLoginExistenceApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        if (request()->has('email')) {
            return [
                'email' => ['email', 'string']
            ];
        } else {
            return [
                'phone' => ['string']
            ];
        }
    }

}