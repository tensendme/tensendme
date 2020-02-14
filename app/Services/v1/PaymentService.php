<?php


namespace App\Services\v1;


interface PaymentService
{

    public function subscribe($request);
//    public function saveTransaction($subscription_type_id,$status,$user,$transaction_id,$reason);
    public function sendCrypto($request);
    public function send3dSecure($request);
    public function saveCard($request);
    public function findAllCardsByUserId($user_id);
    public function cardPay($request);
    public function deleteCard($card_id);





}
