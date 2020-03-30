<?php

namespace App\Http\Requests\Web\V1\SettingControllerRequests;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class LinkStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['string', 'required'],
            'url' => ['string', 'required'],
            'image' => ['image']
        ];
    }
}
