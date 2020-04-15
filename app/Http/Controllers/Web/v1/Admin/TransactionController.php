<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Histories\Transaction;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.userActions.transactions.index', compact('transactions'));
    }

    public function filter(Request $request) {
            $transactions = QueryBuilder::for(Transaction::class)
                ->allowedFilters(['sum',
                    AllowedFilter::exact('status'),
                    AllowedFilter::exact('user_id'),
                    AllowedFilter::scope('created_after'),
                    AllowedFilter::scope('created_before')
                ])
                ->defaultSort('-id')
                ->allowedIncludes(['user'])
                ->allowedSorts('id', 'created_at', 'status', 'sum', 'order_id')
                ->paginate($request->perPage);

        return view('admin.userActions.transactions.table', compact('transactions'));
    }

}
