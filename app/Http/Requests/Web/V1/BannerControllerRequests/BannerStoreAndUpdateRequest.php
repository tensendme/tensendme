<?php

namespace App\Http\Requests\Web\V1\BannerControllerRequests;

use App\Http\Requests\WebBaseRequest;

class BannerStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'news_id' => ['required', 'numeric'],
            'location_id' => ['required', 'numeric'],
            'link' => ['string'],
            'image' => ['image'],
            'payment_enabled' => ['string']
        ];
    }
}

