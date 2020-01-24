<?php

namespace App\Http\Requests\Web\V1\NewsControllerRequests;

use App\Http\Requests\WebBaseRequest;

class NewsStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['image']
        ];
    }
}
