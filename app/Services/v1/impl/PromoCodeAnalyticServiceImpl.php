<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14.02.2020
 * Time: 14:32
 */

namespace App\Services\v1\impl;


use App\Models\Subscriptions\PromoCodeAnalytic;
use App\Services\v1\PromoCodeAnalyticService;

class PromoCodeAnalyticServiceImpl implements PromoCodeAnalyticService
{
    public function makePassed($hostUserId, $promoCodeText)
    {
        PromoCodeAnalytic::create([
            'host_user_id' => $hostUserId,
            'promo_code' => $promoCodeText,
            'type' => PromoCodeAnalytic::TYPE_PASSED
        ]);
    }

    public function makeInstalled($hostUserId, $promoCodeText, $followerUserId)
    {
        $promoCode = PromoCodeAnalytic::where('host_user_id', $hostUserId)
            ->where('follower_user_id', $followerUserId)
            ->where('type', PromoCodeAnalytic::TYPE_INSTALLED)
            ->first();

        if (!$promoCode) {
            PromoCodeAnalytic::create([
                'host_user_id' => $hostUserId,
                'promo_code' => $promoCodeText,
                'type' => PromoCodeAnalytic::TYPE_INSTALLED,
                'follower_user_id' => $followerUserId
            ]);
        }
    }

    public function makePurchased($hostUserId, $promoCodeText, $followerUserId)
    {
        $promoCode = PromoCodeAnalytic::where('host_user_id', $hostUserId)
            ->where('follower_user_id', $followerUserId)
            ->where('type', PromoCodeAnalytic::TYPE_PURCHASED)
            ->first();

        if (!$promoCode) {
            PromoCodeAnalytic::create([
                'host_user_id' => $hostUserId,
                'promo_code' => $promoCodeText,
                'type' => PromoCodeAnalytic::TYPE_PURCHASED,
                'follower_user_id' => $followerUserId
            ]);
        }
    }
}