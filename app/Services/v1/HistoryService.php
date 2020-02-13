<?php


namespace App\Services\v1;


interface HistoryService
{
    public function subscription($subscription, $firstSubscription);
    public function withdrawalMake($withdrawal);
    public function follower($follower);
}
