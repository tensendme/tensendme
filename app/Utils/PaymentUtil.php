<?php


namespace App\Utils;


class PaymentUtil
{

    public const _3D_SECURE_URL = 'https://api.cloudpayments.ru/payments/cards/post3ds';
    public const _REFUND_URL = 'https://api.cloudpayments.ru/payments/refund';
    public const _TOKEN_CHARGE = 'https://api.cloudpayments.ru/payments/tokens/charge';
    public  const  _CARDS_CHARGE = 'https://api.cloudpayments.ru/payments/cards/charge';

    public static function getUsername()
    {
        return env('CLOUDPAYMENTS_USERNAME', null);
    }

    public static function getPassword()
    {
        return env('CLOUDPAYMENTS_PASSWORD', null);
    }

    public static function getBase64EncodedAuthToken()
    {
        return base64_encode(self::getUsername() . ':' . self::getPassword());
    }
}
