<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;


use App\Models\Histories\History;
use App\Models\Histories\HistoryType;
use App\Models\Profiles\Balance;
use App\Models\Profiles\Country;
use App\Services\v1\HistoryService;
use App\Services\v1\PaymentService;
use App\Services\v1\StaticService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class HistoryServiceImpl implements HistoryService
{
    public function subscription($subscription)
    {
        $balance = Balance::where('user_id', $subscription->user_id)->first();
            if (!$balance) {
                $balance = Balance::create([
                    'user_id' => $subscription->user_id,
                    'balance' => 0,
                ]);
            }
            History::create([
                'balance_id' => $balance->id,
                'history_type_id' => HistoryType::SUBSCRIPTION,
                'amount' => $subscription->actual_price,
                'subscription_id' => $subscription->id,
            ]);

    }

}
