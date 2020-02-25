<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PassingRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'lessonId' => ['required', 'numeric'],
        ];
    }
}
