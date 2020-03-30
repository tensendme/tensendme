<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Histories\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.userActions.transactions.index', compact('transactions'));
    }
}
