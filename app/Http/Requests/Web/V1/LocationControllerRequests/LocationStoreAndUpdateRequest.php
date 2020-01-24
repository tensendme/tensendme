<?php


namespace App\Http\Requests\Web\V1\LocationControllerRequests;
use App\Http\Requests\WebBaseRequest;


class LocationStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
