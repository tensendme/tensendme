<?php

namespace App\Http\Requests\Web\V1\MeditationRequests;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class MeditationStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'category_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'image' => ['image'],
            'duration' => ['numeric'],
        ];
    }
}
