<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\HistoryService;
use App\Services\v1\PaymentService;
use App\Services\v1\SubscriptionService;
use Auth;
use DateTime;

class SubscriptionServiceImpl implements SubscriptionService
{
    protected $cloudPaymentService;
    protected $historyService;

    public function __construct(PaymentService $cloudPaymentService, HistoryService $historyService)
    {
        $this->cloudPaymentService = $cloudPaymentService;
        $this->historyService = $historyService;
    }

    public function getSubscriptions()
    {
        return SubscriptionType::all();
    }

    public function subscribe($subscriptionTypeId)
    {
        $subscriptionType = SubscriptionType::find($subscriptionTypeId);
        if (!$subscriptionType) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такой подписки не существует!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);

        $date = new DateTime();
        $date->modify('+' . $subscriptionType->expired_at . 'days');
        $user = Auth::user();
        $userSubscription = $user->lastSubscription();
        if ($userSubscription) {
            $date = new DateTime($userSubscription->expired_at);
            $date->modify('+' . $subscriptionType->expired_at . 'days');
        }
        $this->cloudPaymentService->getPay($user->id);
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'subscription_type_id' => $subscriptionTypeId,
            'expired_at' => $date,
            'actual_price' => $subscriptionType->price
        ]);
        $this->historyService->subscription($subscription);
        return "Успешно!";
    }
}
