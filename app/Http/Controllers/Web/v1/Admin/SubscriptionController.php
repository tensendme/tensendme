<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Subscriptions\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends WebBaseController
{

    public function index()
    {
        $subscriptions = Subscription::paginate(10);
        return view('admin.userActions.subscriptions.index',compact('subscriptions'));
    }
}
