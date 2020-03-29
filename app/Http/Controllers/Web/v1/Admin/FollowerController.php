<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\Follower;
use Illuminate\Http\Request;

class FollowerController extends WebBaseController
{
    public function index() {
        $followers = Follower::orderBy('created_at', 'desc')->with('level', 'hostUser', 'followerUser')->paginate(10);
        return view('admin.userActions.followers.index', compact('followers'));
    }
}
