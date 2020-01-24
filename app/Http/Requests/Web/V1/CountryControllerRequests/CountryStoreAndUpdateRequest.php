<?php


namespace App\Http\Requests\Web\V1\CountryControllerRequests;

use App\Http\Requests\WebBaseRequest;


class CountryStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone_prefix' => ['required', 'string'],
            'image' => ['image']
        ];
    }
}
