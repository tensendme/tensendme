<?php

namespace App\Http\Controllers\Api\V1\Subscription;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Services\v1\StaticService;
use App\Services\v1\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends ApiBaseController
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function getSubscriptionTypes() {
        return $this->successResponse(['subscription_types' => $this->subscriptionService->getSubscriptions()]);
    }

    public function subscribe($subscriptionTypeId) {
        return $this->successResponse(['message' => $this->subscriptionService->subscribe($subscriptionTypeId)]);
    }
}
