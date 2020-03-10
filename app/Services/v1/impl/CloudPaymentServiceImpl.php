<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Histories\Transaction;
use App\Models\Profiles\Card;
use App\Models\Profiles\User;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\PaymentService;
use App\Services\v1\SubscriptionService;
use App\Utils\PaymentUtil;
use Auth;

class CloudPaymentServiceImpl implements PaymentService
{


    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {

        $this->subscriptionService = $subscriptionService;
    }


    public function subscribe($request)
    {
        $token = $request->token;
        $subscription_type_id = $request->subscription_type_id;
        $subscription_type = SubscriptionType::where('id',$subscription_type_id)->where('price','!=',0)->first();
        if (!$subscription_type) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такой подписки не существует!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $url = route('cryptogram');
//        $result = ['url' => $url, 'subscription_type_id' => $subscription_type_id , 'token' => $token];

        $result = view('cryptogram',compact('subscription_type','token'));
        return  $result;

    }

    public function saveCard($request)
    {
        $token = $request->token;

        $url = route('saveCard');
//        $result = ['url' => $url, 'token' =>$token];
        $result = view('saveCard',compact('token'));
        return $result;
    }

    public function deleteCard($card_id)
    {
        $user = Auth::user();
        $card = Card::findOrFail($card_id);

        if ($user->id!=$card->user_id) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такой карты не существует!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        Card::destroy($card_id);
        $result =  "Карта успешно удалена";
        return $result;
    }

    public function findAllCardsByUserId()
    {
        $user = Auth::user();
        $cards = Card::where('user_id', $user->id)->get(['id','token','type','last_four']);
        foreach ($cards as $card)
        {
            if ($card->type == "MasterCard"){

                $card->type = '/images/masterCardLogo.png';
            }
            else {
                $card->type = '/images/visaLogo.png';
            }
        }
        return $cards;
    }


    public function sendCrypto($request)
    {


        $Amount = $request->Amount;
        $Currency = "KZT";
        $IpAddress = $request->ip();
        $Name = $request->CardHolderName;
        $CardCryptogramPacket = $request->CardCryptogramPacket;
        $user = Auth::user();
        $user_id = $user->id;

        $url = PaymentUtil::_CARDS_CHARGE;

        $json = [
            'Amount' => $Amount,
            'Currency' => $Currency,
            'IpAddress'=> $IpAddress,
            'Name'=>$Name,
            'AccountId'=>$user_id,
            'CardCryptogramPacket'=>$CardCryptogramPacket
        ];
        $json = json_encode($json);
        $response = $this->makeCurlRequest($url, $json);
        $response = json_decode($response);



        $transaction = Transaction::create([
            'user_id' => $user->id,
            'sum' => $Amount,
            'status' => Transaction::PROCESSING,
            'order_id' => $response->Model->TransactionId
        ]);


        if (isset($request->subscription_type_id)) {

            $subscription_type_id = $request->subscription_type_id;
            $result = $this->createSubscription($subscription_type_id, $transaction, $response);
        } else {
            $result = $this->createUserCard($response, $transaction);
        }

        return $result;
    }

    public function cardPay($request)
    {

        $subscription_type = SubscriptionType::find($request->subscription_type_id);
        if (!$subscription_type) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такой подписки не существует!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);

        $Amount = $subscription_type->price;
        $user = Auth::user();
        $user_id = $user->id;
        $token = $request->token;


        $url = PaymentUtil::_TOKEN_CHARGE;

        $json = [
            'Amount' => $Amount,
            'Currency' => "KZT",
            'AccountId'=> $user_id,
            'Token'=>$token
        ];
        $json = json_encode($json);
        $response = $this->makeCurlRequest($url, $json);

        $response = json_decode($response);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'sum' => $Amount,
            'status' => Transaction::PROCESSING,
            'order_id' => $response->Model->TransactionId
        ]);

        $card_holder_message = $response->Model->CardHolderMessage;
        $external_status = $response->Model->Status;
        $currency = $response->Model->PaymentCurrency;

        if ($response->Success == true) {


            $transaction->update(['status' => Transaction::APPROVED,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);

            $this->subscriptionService->makeSubscription($request->subscription_type_id,$user, $transaction->id);


        } else {

            $transaction->update(['status' => Transaction::CANCELLED,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);
        }

        $result = $card_holder_message;
        return $result;
    }

    public function createSubscription($subscription_type_id, $transaction, $response)
    {
        if ($response->Success == true) {
            $card_holder_message = $response->Model->CardHolderMessage;
            $external_status = $response->Model->Status;
            $currency = $response->Model->PaymentCurrency;
            $transaction->update(['status' => Transaction::APPROVED,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);
            $transaction_id = $transaction->id;
            $user = Auth::user();
            $this->subscriptionService->makeSubscription($subscription_type_id,$user,$transaction_id);
            $user_id = $transaction->user_id;

            if (Card::where('token', $response->Model->Token)->first() == null) {
                Card::create([
                    'user_id' => $user_id,
                    'token' => $response->Model->Token,
                    'type' => $response->Model->CardType,
                    'last_four' => $response->Model->CardLastFour
                ]);
            }

            $url = route('transactionStatus');
            $result = ['url' => $url, 'transaction_id' => $transaction_id];

        } else if (isset($response->Model->PaReq)) {
            $PaReq = $response->Model->PaReq;
            $MD = $response->Model->TransactionId;
            $TermUrl = env('APP_URL'). "/api/v1/3d/secure";
            $AcsUrl = $response->Model->AcsUrl;

            $result = [
                'TransactionId' => $MD,
                'PaReq' => $PaReq,
                'TermUrl' => $TermUrl,
                'AcsUrl' => $AcsUrl,
            ];
            $result = json_encode($result);

        } else {
            $card_holder_message = $response->Model->CardHolderMessage;
            $external_status = $response->Model->Status;
            $currency = $response->Model->PaymentCurrency;
            $transaction->update(['status' => Transaction::CANCELLED,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);
            $transaction_id = $transaction->id;


            $url = route('transactionStatus');
            $result = ['url' => $url, 'transaction_id' => $transaction_id];

        }

        return $result;


    }

    public function createUserCard($response, $transaction)
    {
        if ($response->Success == true) {
            $card_holder_message = $response->Model->CardHolderMessage;
            $external_status = $response->Model->Status;
            $currency = $response->Model->PaymentCurrency;
            $transaction->update(['status' => Transaction::CARD_SAVE_SUCCESS,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);
            $transaction_id = $transaction->id;
            $user_id = $transaction->user_id;
            $external_transaction_id = $transaction->order_id;

            if (Card::where('token', $response->Model->Token)->where('user_id',$user_id)->first() == null) {
                Card::create([
                    'user_id' => $user_id,
                    'token' => $response->Model->Token,
                    'type' => $response->Model->CardType,
                    'last_four' => $response->Model->CardLastFour
                ]);
            }
            sleep(7);

            $url = PaymentUtil::_REFUND_URL;
            $json = [
                'TransactionId' => $external_transaction_id,
                'Amount' => 0.01
            ];
            $json = json_encode($json);

            $this->makeCurlRequest($url, $json);

            $url = route('cardStatus');
            $result = ['url' => $url, 'transaction_id' => $transaction_id];

        } else if (isset($response->Model->PaReq)) {
            $PaReq = $response->Model->PaReq;
            $MD = $response->Model->TransactionId;
            $TermUrl = env('APP_URL'). "/api/v1/3d/secure";
            $AcsUrl = $response->Model->AcsUrl;

            $result = [
                'TransactionId' => $MD,
                'PaReq' => $PaReq,
                'TermUrl' => $TermUrl,
                'AcsUrl' => $AcsUrl,
            ];
            $result = json_encode($result);
        } else {
            $card_holder_message = $response->Model->CardHolderMessage;
            $external_status = $response->Model->Status;
            $currency = $response->Model->PaymentCurrency;
            $transaction->update(['status' => Transaction::CARD_SAVE_FAILURE,
                'card_holder_message' => $card_holder_message,
                'external_status' => $external_status,
                'currency' => $currency]);
            $transaction_id = $transaction->id;


            $url = route('cardStatus');
            $result = ['url' => $url, 'transaction_id' => $transaction_id];

        }

        return $result;
    }


    public function send3dSecure($request)
    {
        $MD = $request->MD;
        $PaRes = $request->PaRes;
        $url = PaymentUtil::_3D_SECURE_URL;

        $json = [
            'TransactionId' => $MD,
            'PaRes' => $PaRes
        ];
        $json = json_encode($json);

        $response = $this->makeCurlRequest($url, $json);
        $response = json_decode($response);
        $order_id = $response->Model->TransactionId;

        $transaction = Transaction::where('order_id', $order_id)->first();

        $user = User::where('id', $transaction->user_id)->first();
        $sum = $response->Model->Amount;

        if ($response->Success != true) {
            if ($sum == 0.01) {
                $card_holder_message = $response->Model->CardHolderMessage;
                $external_status = $response->Model->Status;
                $currency = $response->Model->PaymentCurrency;
                $transaction->update(['status' => Transaction::CARD_SAVE_FAILURE,
                    'card_holder_message' => $card_holder_message,
                    'external_status' => $external_status,
                    'currency' => $currency]);
                $result = view('cardStatus', compact('transaction'));
            } else {
                $card_holder_message = $response->Model->CardHolderMessage;
                $external_status = $response->Model->Status;
                $currency = $response->Model->PaymentCurrency;
                $transaction->update(['status' => Transaction::CANCELLED,
                    'card_holder_message' => $card_holder_message,
                    'external_status' => $external_status,
                    'currency' => $currency]);
                $result = view('transactionStatus', compact('transaction', 'user'));
            }
        } else {

            if ($sum == 0.01) {
                $card_holder_message = $response->Model->CardHolderMessage;
                $external_status = $response->Model->Status;
                $currency = $response->Model->PaymentCurrency;
                $transaction->update(['status' => Transaction::CARD_SAVE_SUCCESS,
                    'card_holder_message' => $card_holder_message,
                    'external_status' => $external_status,
                    'currency' => $currency]);


                $json = [
                    'TransactionId' => $transaction->order_id,
                    'Amount' => 0.01
                ];
                $json = json_encode($json);
                sleep(7);
                $url = PaymentUtil::_REFUND_URL;
                $this->makeCurlRequest($url, $json);


                if (Card::where('token', $response->Model->Token)->where('user_id',$transaction->user_id)->first()  == null) {
                    Card::create([
                        'user_id' => $user->id,
                        'token' => $response->Model->Token,
                        'type' => $response->Model->CardType,
                        'last_four' => $response->Model->CardLastFour
                    ]);
                }
                $result = view('cardStatus', compact('transaction'));
            } else {
                $subscription_type = SubscriptionType::where('price', $sum)->first();
                $card_holder_message = $response->Model->CardHolderMessage;
                $external_status = $response->Model->Status;
                $currency = $response->Model->PaymentCurrency;
                $transaction->update(['status' => Transaction::APPROVED,
                    'card_holder_message' => $card_holder_message,
                    'external_status' => $external_status,
                    'currency' => $currency]);
                $this->subscriptionService->makeSubscription($subscription_type->id, $user, $transaction->id);
                $result = view('transactionStatus', compact('transaction', 'user'));
            }
            if (Card::where('token', $response->Model->Token)->first() == null) {
                Card::create([
                    'user_id' => $user->id,
                    'token' => $response->Model->Token,
                    'type' => $response->Model->CardType,
                    'last_four' => $response->Model->CardLastFour
                ]);
            }

        }
        return $result;
    }

    protected function makeCurlRequest($url, $json)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Basic ".PaymentUtil::getBase64EncodedAuthToken()
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}

