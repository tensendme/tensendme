<?php

namespace App\Http\Controllers\Web\v1;

use App\Exceptions\ApiServiceException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Errors\ErrorCode;
use App\Models\Histories\Transaction;
use App\Models\Profiles\Country;
use App\Models\Subscriptions\SubscriptionType;
use App\Models\Profiles\User;
use Illuminate\Http\Request;

class PaymentController extends WebBaseController
{
    public function pay(Request $request)
    {

        $token = $request->token;
        $subscription_type = SubscriptionType::find($request->subscription_type_id);

        return view('cryptogram', compact('subscription_type', 'token'));
    }

    public function saveCard(Request $request)
    {
        $token = $request->token;
        return view('saveCard', compact('token'));
    }

    public function status(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);
        $user = User::find($transaction->user_id);
        return view('transactionStatus', compact('transaction', 'user'));
    }

    public function cardStatus(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);

        return view('cardStatus', compact('transaction'));
    }

    public function subscribe()
    {
        $subscriptions = SubscriptionType::where('is_visible', true)
            ->where('price', '!=', 0)
            ->get();
        $countries = Country::all();
        return view('subscription', compact('subscriptions', 'countries'));
    }

    public function test()
    {

        return view('testMobilka');
    }
}
