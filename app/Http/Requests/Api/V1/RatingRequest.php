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
            'scale' => ['required','numeric', 'max:5', 'min:0.1']
        ];
    }
}
