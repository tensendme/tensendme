<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:05
 */

namespace App\Services\v1;


interface SubscriptionService
{
    public function getSubscriptions();
    public function subscribe($subscriptionTypeId);
    public function makeSubscription($subscriptionTypeId, $user, $transactionId);
    public function freeSubscribe($userId);
}
