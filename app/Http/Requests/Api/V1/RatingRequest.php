<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'course_id' => ['required', 'numeric'],
            'scale' => 'numeric',
        ];
    }
}
