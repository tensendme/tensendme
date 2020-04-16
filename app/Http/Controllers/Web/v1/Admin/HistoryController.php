<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Histories\HistoryType;
use App\Models\Profiles\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;

class HistoryController extends WebBaseController
{
    public function index() {
        $histories = History::orderBy('created_at', 'desc')->with('balance.user', 'historyType')->paginate(10);
        $history_types = HistoryType::all();
        return view('admin.userActions.histories.index', compact('histories', 'history_types'));
    }

    public function filter(Request $request) {
        $histories = \Spatie\QueryBuilder\QueryBuilder::for(History::class)
            ->allowedFilters(['amount',
                AllowedFilter::exact('subscription_type_id'),
                AllowedFilter::exact('balance_id'),
                AllowedFilter::exact('transaction_id'),
                AllowedFilter::exact('subscription_id'),
                AllowedFilter::exact('withdrawal_request_id'),
                AllowedFilter::exact('history_type_id'),
                AllowedFilter::scope('created_after'),
                AllowedFilter::scope('created_before'),
            ])
            ->defaultSort('-id')
            ->allowedIncludes(['balance.user', 'historyType'])
            ->allowedSorts('id', 'created_at', 'amount', 'history_type_id')
            ->paginate($request->perPage);

        return view('admin.userActions.histories.table', compact('histories'));
    }
}
