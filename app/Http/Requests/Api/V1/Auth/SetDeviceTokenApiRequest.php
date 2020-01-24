<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;
use App\Models\Profiles\User;

class SetDeviceTokenApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'device_token' => ['required', 'string'],
            'platform' => ['required', 'string', "in:" . User::PLATFORM_ANDROID . "," . User::PLATFORM_IOS]
        ];
    }

}
