<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\WithdrawalRequest;
use App\Services\v1\WithdrawalRequestService;

class WithdrawalController extends WebBaseController
{
    protected $withdrawalService;

    public function __construct(WithdrawalRequestService $withdrawalRequest)
    {
        $this->withdrawalService = $withdrawalRequest;
    }

    public function index() {
        $withdrawals = WithdrawalRequest::paginate(10);
        return view('admin.userActions.withdrawals.index',compact('withdrawals'));
    }

    public function approve($id) {
        $this->withdrawalService->approve($id);
        $this->edited();
        return redirect()->route('withdrawal.index');

    }
}
