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
use App\Models\Profiles\User;
use App\Services\v1\HistoryService;


class HistoryServiceImpl implements HistoryService
{
    public function subscription($subscription)
    {
        $user = User::find($subscription->user_id);
        $balance = $user->getBalance();
            History::create([
                'balance_id' => $balance->id,
                'history_type_id' => HistoryType::SUBSCRIPTION,
                'amount' => $subscription->actual_price,
                'subscription_id' => $subscription->id,
                //'transaction_id' => '1' от банка что то должно быть
            ]);

    }

    public function withdrawalMake($withdrawal)
    {
        $user = User::find($withdrawal->user_id);
        $balance = $user->getBalance();
        History::create([
            'balance_id' => $balance->id,
            'history_type_id' => HistoryType::WITHDRAWAL,
            'amount' => $withdrawal->amount,
            'withdrawal_request_id' => $withdrawal->id,
//            'transaction_id' => '1' от банка что то должно быть
        ]);


    }


}
