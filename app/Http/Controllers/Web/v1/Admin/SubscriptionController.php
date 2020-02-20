<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionController extends WebBaseController
{

    public function index()
    {
        $subscriptionType = SubscriptionType::where('price', 0)->first();
        $subscriptions = Subscription::where('subscription_type_id', '!=', $subscriptionType->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.userActions.subscriptions.index',compact('subscriptions'));
    }
}
