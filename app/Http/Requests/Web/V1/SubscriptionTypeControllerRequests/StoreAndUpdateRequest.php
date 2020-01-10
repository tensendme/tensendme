<?php


namespace App\Http\Requests\Web\V1\SubscriptionTypeControllerRequests;

use App\Http\Requests\WebBaseRequest;


class StoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'expired_at' => ['required', 'numeric']

        ];
    }
}
