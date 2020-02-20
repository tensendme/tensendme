<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\WithdrawalControllerRequests\WithdrawalStoreAndUpdateRequest;
use App\Models\Histories\WithdrawalRequest;
use App\Services\v1\WithdrawalRequestService;
use Illuminate\Http\Request;

class WithdrawalController extends WebBaseController
{
    protected $withdrawalService;

    public function __construct(WithdrawalRequestService $withdrawalRequest)
    {
        $this->withdrawalService = $withdrawalRequest;
    }

    public function index() {
        $withdrawals = WithdrawalRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.userActions.withdrawals.index',compact('withdrawals'));
    }

    public function approve(Request $request, $id) {
        $this->withdrawalService->approve($id, $request->comment);
        $this->edited();
        return redirect()->route('withdrawal.index');

    }

    public  function cancel(Request $request, $id){
        $this->withdrawalService->cancel($id, $request->comment);
        $this->edited();
        return redirect()->route('withdrawal.index');
    }
}
