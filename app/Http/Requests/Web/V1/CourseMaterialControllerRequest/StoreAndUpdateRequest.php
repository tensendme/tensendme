<?php

namespace App\Http\Requests\Web\V1\CourseMaterialControllerRequest;

use App\Http\Requests\WebBaseRequest;

class StoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'title' => ['required', 'string'],
            'course_id' => ['required', 'numeric'],
            'ordering' => ['required', 'numeric'],
            'video' => ['mimetypes:video/*']
        ];
    }
}
