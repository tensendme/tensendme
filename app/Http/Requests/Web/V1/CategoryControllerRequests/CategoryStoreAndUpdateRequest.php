<?php

namespace App\Http\Requests\Web\V1\CategoryControllerRequests;

use App\Http\Requests\WebBaseRequest;

class CategoryStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {

        if (request()->get('parent_category_id') == '') {
            $this->request->set('parent_category_id', null);
        }

        return [
            'name' => ['required', 'string'],
            'category_type_id' => ['required', 'numeric'],
            'parent_category_id' => ['nullable'],
        ];
    }

}
