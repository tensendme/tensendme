<?php

namespace App\Http\Controllers\Api\V1\CloudPayments;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\v1\PaymentService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends ApiBaseController
{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function subscribe(Request $request) {


        return $this->successResponse(['result' => $this->paymentService->subscribe($request)]);

    }


    public function saveCard(Request $request) {


        return $this->successResponse(['result' => $this->paymentService->saveCard($request)]);

    }

    public function deleteCard($card_id) {


        return $this->successResponse(['result' => $this->paymentService->deleteCard($card_id)]);

    }

    public function saveTransaction(Request $request) {

        $subscription_type_id = $request->subscription_type_id;


        $user = Auth::user();
        $status = $request->status;
        $transaction_id = $request->transaction_id;
        $reason = $request->reason ? $request->reason : 'Успешно';

        return $this->paymentService->saveTransaction($subscription_type_id,$status,$user,$transaction_id,$reason);
    }

    public function sendCrypto(Request $request) {

        return $this->paymentService->sendCrypto($request);
    }

    public function send3dSecure(Request $request) {

        return $this->paymentService->send3dSecure($request);
    }

    public function getCardsByUserId()
    {
        $cards = $this->paymentService->findAllCardsByUserId();

        return $this->successResponse(['cards' => $cards]);

    }


    public function cardPay(Request $request)
    {

        return $this->successResponse(['result' => $this->paymentService->cardPay($request)]);

    }



}
