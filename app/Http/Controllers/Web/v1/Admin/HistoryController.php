<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Profiles\User;
use Doctrine\DBAL\Query\QueryBuilder;

class HistoryController extends WebBaseController
{
    public function index() {
        $histories = History::orderBy('created_at', 'desc')->with('balance.user', 'historyType')->paginate(10);
        return view('admin.userActions.histories.index', compact('histories'));
    }

    public function filter() {
        $histories = QueryBuilder::for(User::class)
            ->allowedFilters(['balance_id','history_type_id', 'withdrawal_request_id',
                'transaction_id', 'subscription_id', 'follower_id'])
            ->orderBy('created_at', 'desc')
            ->with('balance.user', 'historyType')->paginate(10);
        return view('admin.userActions.histories.table', compact('histories'));
    }
}
