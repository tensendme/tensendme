<?php


namespace App\Services\v1;


interface HistoryService
{
    public function subscription($subscription);
    public function withdrawalMake($withdrawal);
    public function follower($follower);
}
