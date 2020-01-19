<?php

namespace App\Http\Requests\Web\V1\FAQControllerRequests;

use App\Http\Requests\WebBaseRequest;

class StoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'image' => ['image']
        ];
    }
}

