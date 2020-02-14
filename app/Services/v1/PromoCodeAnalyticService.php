<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14.02.2020
 * Time: 14:32
 */

namespace App\Services\v1;

interface PromoCodeAnalyticService
{
    public function makePassed($hostUserId, $promoCode);

    public function makeInstalled($hostUserId, $promoCodeText, $followerUserId);

    public function makePurchased($hostUserId, $promoCodeText, $followerUserId);

}