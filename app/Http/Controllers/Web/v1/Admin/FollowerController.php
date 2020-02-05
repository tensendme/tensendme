<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Histories\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function index() {
        $followers = Follower::paginate(10);
        return view('admin.userActions.followers.index', compact('followers'));
    }
}
