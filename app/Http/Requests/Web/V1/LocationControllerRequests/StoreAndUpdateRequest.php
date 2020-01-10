<?php


namespace App\Http\Requests\Web\V1\LocationControllerRequests;
use App\Http\Requests\WebBaseRequest;


class StoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],

        ];
    }
}
