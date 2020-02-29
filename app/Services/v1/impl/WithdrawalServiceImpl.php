<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\CloudMessaging\Pushes\GeneralPush;
use App\Exceptions\ApiServiceException;
use App\Exceptions\WebServiceErroredException;
use App\Http\Errors\ErrorCode;
use App\Jobs\SendPush;
use App\JobTemplates\PushJobTemplate;
use App\Models\Histories\WithdrawalRequest;
use App\Models\Profiles\User;
use App\Queues\QueueConstants;
use App\Services\v1\HistoryService;
use App\Services\v1\PaymentService;
use App\Services\v1\PushService;
use App\Services\v1\WithdrawalRequestService;
use Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalServiceImpl implements WithdrawalRequestService
{

    protected $historyService;
    protected $pushService;

    public function __construct(HistoryService $historyService, PushService $pushService)
    {
        $this->pushService = $pushService;
        $this->historyService = $historyService;
    }

    public function withdrawalRequest($amount, $comment)
    {
        $user = Auth::user();
        $balance = $user->getBalance();
        if ($balance->balance < $amount) throw new ApiServiceException(400, false, [
            'errors' => [
                'Не хватает баланса!'
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

    public function approve($id, $comment)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);
        if ($withdrawal->status != WithdrawalRequest::PROCESSING) {
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Запрос уже обработан');
        }
        $user = User::find($withdrawal->user_id);
        $balance = $user->balance;

        if ($withdrawal->amount > $balance->balance) {
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Не хватает суммы!');
        }

        DB::beginTransaction();
        try {
            $balance->balance = $balance->balance - $withdrawal->amount;
            $balance->save();

            $withdrawal->status = WithdrawalRequest::APPROVED;
            $withdrawal->approved_by = Auth::user()->id;
            $withdrawal->comment = $comment;
            $withdrawal->approved_at = now();
            $this->historyService->withdrawalMake($withdrawal);
            $withdrawal->save();
            $this->pushService
                ->passGeneralPushToQueue(
                    $user,
                    'Ваша заявка по выдаче денег обработана!',
                    $comment);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Произошла ошибка обратитесь к администратору!');
        }
    }

    public function cancel($id, $comment)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);
        if ($withdrawal->status != WithdrawalRequest::PROCESSING) {
            throw new WebServiceErroredException(trans('admin.error') . ': ' . 'Запрос уже обработан!');
        }
        $withdrawal->status = WithdrawalRequest::CANCELLED;
        $withdrawal->approved_by = Auth::user()->id;
        $withdrawal->approved_at = now();
        $withdrawal->comment = $comment;

        $this->historyService->withdrawalMake($withdrawal);
        $withdrawal->save();
        // Push notification
    }

}
