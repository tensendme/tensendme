<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Profiles\User;
use App\Models\Rating;
use App\Models\Subscriptions\Subscription;

class HomeController extends WebBaseController
{


    public function index()
    {
        $usersCount = User::all()->count();
        $historiesCount = History::all()->count();
        $subscriptionsCount = Subscription::all()->count();
        $ratingsCount = Rating::all()->count();
        return view('admin.home', compact('usersCount', 'historiesCount', 'subscriptionsCount', 'ratingsCount'));
    }

    public function welcome()
    {
        return view('welcome');
    }

}
