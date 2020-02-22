<?php

namespace App\Http\Requests\Web\V1\MeditationRequests;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AudioRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'author_id' => ['required', 'numeric'],
            'language_id' => ['required', 'numeric'],
            'audio' => ['mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'],
            'access' => ['numeric']
        ];
    }
}
