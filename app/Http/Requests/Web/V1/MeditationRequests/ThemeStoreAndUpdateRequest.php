<?php

namespace App\Http\Requests\Web\V1\MeditationRequests;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ThemeStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'audio' => ['array']
        ];
    }
}
