<?php

namespace App\Http\Controllers\Api\V1\Withdrawal;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\WithdrawalRequest;
use App\Services\v1\WithdrawalRequestService;

class WithdrawalController extends ApiBaseController
{
    protected $withdrawalRequest;

    public function __construct(WithdrawalRequestService $withdrawalRequest)
    {
        $this->withdrawalRequest = $withdrawalRequest;
    }

    public function withdrawalRequest(WithdrawalRequest $request) {
        return $this->successResponse(['message' => $this->withdrawalRequest->withdrawalRequest(
            $request->amount, $request->comment)]);
    }
}
