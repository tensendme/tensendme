<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use Illuminate\Support\Facades\DB;
use App\Http\Errors\ErrorCode;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\HistoryService;
use App\Services\v1\PaymentService;
use App\Services\v1\SubscriptionService;
use Auth;
use DateTime;
use Mockery\Exception;

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
//        $this->cloudPaymentService->getPay($user->id);
        DB::beginTransaction();
        $oldSubscription = Subscription::where('user_id', $user->id)->where('actual_price', '!=', 0)->get();
        $price = $subscriptionType->price;
        if($oldSubscription->isEmpty()) {
            $price = $price * 80/100;
        }
        try {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_type_id' => $subscriptionTypeId,
                'expired_at' => $date,
                'actual_price' => $price
            ]);
            $this->historyService->subscription($subscription);
            DB::commit();
            return "Успешно!";
        }
        catch (\Exception $exception) {
            DB::rollBack();
            throw new ApiServiceException(500, false, ['errors' => [$exception->getMessage()],
                'errorCode' => ErrorCode::SYSTEM_ERROR
            ]);
    }
    }

    public function freeSubscribe($userId)
    {
        $subscriptionType = SubscriptionType::where('price', 0)->first();
        $date = new DateTime();
        $date->modify('+' . $subscriptionType->expired_at . 'days');
        Subscription::create([
            'user_id' => $userId,
            'subscription_type_id' => $subscriptionType->id,
            'expired_at' => $date,
            'actual_price' => $subscriptionType->price
        ]);
    }


}
