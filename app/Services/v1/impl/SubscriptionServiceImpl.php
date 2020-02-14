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
use App\Services\v1\SubscriptionService;
use Auth;
use DateTime;
use Mockery\Exception;

class SubscriptionServiceImpl implements SubscriptionService
{

    protected $historyService;

    public function __construct( HistoryService $historyService)
    {

        $this->historyService = $historyService;
    }

    public function getSubscriptions()
    {
        $subscriptionType = SubscriptionType::where('price', 0)->first();
        return SubscriptionType::where('subscription_type_id', '!=', $subscriptionType->id)->get();
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
        $firstSubscription = false;
        $price = $subscriptionType->price;
        if($oldSubscription->isEmpty()) {
            $price = $price * 80/100;
            $firstSubscription = true;
        }
        try {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_type_id' => $subscriptionTypeId,
                'expired_at' => $date,
                'actual_price' => $price
            ]);
            $this->historyService->subscription($subscription, $firstSubscription);
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


    public function makeSubscription($subscriptionTypeId,$user)
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

        $userSubscription = $user->lastSubscription();
        if ($userSubscription) {
            $date = new DateTime($userSubscription->expired_at);
            $date->modify('+' . $subscriptionType->expired_at . 'days');
        }
        DB::beginTransaction();
        $oldSubscription = Subscription::where('user_id', $user->id)->where('actual_price', '!=', 0)->get();
        $firstSubscription = false;
        $price = $subscriptionType->price;
        if ($oldSubscription->isEmpty()) {
            $price = $price * 80 / 100;
            $firstSubscription = true;
        }
        try {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_type_id' => $subscriptionTypeId,
                'expired_at' => $date,
                'actual_price' => $price
            ]);
            $this->historyService->subscription($subscription, $firstSubscription);
            DB::commit();
            return "Успешно!";
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ApiServiceException(500, false, ['errors' => [$exception->getMessage()],
                'errorCode' => ErrorCode::SYSTEM_ERROR
            ]);
        }
    }
}
