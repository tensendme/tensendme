<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AvatarRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'avatar' => ['required', 'image'],
        ];
    }
}
