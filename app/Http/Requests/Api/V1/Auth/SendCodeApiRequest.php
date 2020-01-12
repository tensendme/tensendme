<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class SendCodeApiRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'phone' => ['required', 'string']
        ];
    }

}
