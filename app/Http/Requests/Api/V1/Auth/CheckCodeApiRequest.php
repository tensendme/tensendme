<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CheckCodeApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'login' => ['string', 'required'],
            'code' => ['required']
        ];
    }

}
