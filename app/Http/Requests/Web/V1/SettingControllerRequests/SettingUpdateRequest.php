<?php

namespace App\Http\Requests\Web\V1\SettingControllerRequests;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'about_us' => ['required', 'string'],
            'title' => ['string'],
            'address' => ['string'],
            'phone' => ['string'],
            'copyright' => ['string'],
            'logo' => ['image']
        ];
    }
}
