<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use App\Models\Profiles\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'name' => ['string'],
            'nickname' => ['string'],
            'cityId' => ['numeric'],
        ];
    }
}
