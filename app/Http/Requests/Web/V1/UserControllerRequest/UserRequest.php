<?php

namespace App\Http\Requests\Web\V1\UserControllerRequest;

use App\Http\Requests\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'role_id' => ['required', 'numeric'],
        ];
    }
}
