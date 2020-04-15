<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\Follower;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FollowerController extends WebBaseController
{
    public function index() {
        $followers = Follower::orderBy('created_at', 'desc')->with('level', 'hostUser', 'followerUser')->paginate(10);
        return view('admin.userActions.followers.index', compact('followers'));
    }

    public function filter(Request $request) {
        $followers = QueryBuilder::for(Follower::class)
            ->allowedFilters([
                AllowedFilter::exact('follower_user_id'),
                AllowedFilter::exact('host_user_id'),
                AllowedFilter::scope('created_after'),
                AllowedFilter::scope('created_before'),
            ])
            ->defaultSort('-id')
            ->allowedIncludes(['level', 'hostUser', 'followerUser'])
            ->allowedSorts('id', 'created_at', 'level_id')
            ->paginate($request->perPage);

        return view('admin.userActions.followers.table', compact('followers'));
    }
}
