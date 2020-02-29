<?php


namespace App\Services\v1;


interface LevelService
{
    public function checkLevel($followerUserId, $hostUserId, $subscriptionId, $levelId);
}
