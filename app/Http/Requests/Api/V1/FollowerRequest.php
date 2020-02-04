<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class FollowerRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'promoCode' => ['required', 'string', 'max:6', 'min:6'],
        ];
    }
}
