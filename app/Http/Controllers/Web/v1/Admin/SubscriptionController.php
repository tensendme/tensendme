<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Subscriptions\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends WebBaseController
{

    public function index($pageSize = 10)
    {
        $subscriptions = Subscription::paginate($pageSize);

        return view('admin.subscription.index',compact('subscriptions'));
    }
}
