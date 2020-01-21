<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'phone' => ['string'],
            'email' => ['string', 'email'],
            'password' => ['string', 'min:8', 'required'],
            'code' => ['string', 'required']
        ];
    }

}
