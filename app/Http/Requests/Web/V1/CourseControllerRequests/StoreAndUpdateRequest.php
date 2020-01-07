<?php

namespace App\Http\Requests\Web\V1\CourseControllerRequests;

use App\Http\Requests\WebBaseRequest;

class StoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'category_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'image' => ['image']
        ];
    }
}
