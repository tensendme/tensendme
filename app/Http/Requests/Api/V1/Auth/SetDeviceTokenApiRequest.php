<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SetDeviceTokenApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'device_token' => ['required', 'string']
        ];
    }

}
