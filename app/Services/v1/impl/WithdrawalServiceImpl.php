<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Exceptions\WebServiceErroredException;
use App\Http\Errors\ErrorCode;
use App\Models\Histories\WithdrawalRequest;
use App\Models\Profiles\User;
use App\Services\v1\HistoryService;
use App\Services\v1\PaymentService;
use App\Services\v1\WithdrawalRequestService;
use Auth;

class WithdrawalServiceImpl implements WithdrawalRequestService
{
    protected $cloudPaymentService;
    protected $historyService;

    public function __construct(PaymentService $cloudPaymentService, HistoryService $historyService)
    {
        $this->cloudPaymentService = $cloudPaymentService;
        $this->historyService = $historyService;
    }

    public function withdrawalRequest($amount, $comment)
    {
        $user = Auth::user();
        $balance = $user->getBalance();
        if($balance->balance<$amount) throw new ApiServiceException(400, false, [
            'errors' => [
                'Не хватает суммы!'
            ],
            'errorCode' => ErrorCode::NOT_ENOUGH_BALANCE
        ]);
        WithdrawalRequest::create([
            'user_comment' => $comment,
            'amount' => $amount,
            'user_id' => $user->id,
            'status' => WithdrawalRequest::PROCESSING
        ]);
        return "Ваш запрос успешно отправлен, в течений 2-3 суток вам поступят деньги на карту которую вы привязали!";
    }

    public function approve($id) {
        $withdrawal = WithdrawalRequest::findOrFail($id);
        if($withdrawal->status == WithdrawalRequest::APPROVED) {
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Уже подтвержден!');
        }
        $user = User::find($withdrawal->user_id);
        $balance = $user->balance;

        if($withdrawal->amount > $balance->balance) {
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Не хватает суммы!');
        }
        $balance->balance = $balance->balance - $withdrawal->amount;
        $balance->save();

        $this->cloudPaymentService->withdrawPay();
        $withdrawal->status = WithdrawalRequest::APPROVED;
        $withdrawal->approved_by = Auth::user()->id;
        $withdrawal->approved_at = now();
        $this->historyService->withdrawalMake($withdrawal);
        $withdrawal->save();
    }

}
