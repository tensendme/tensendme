<?php


namespace App\Http\Utils;


use Illuminate\Support\Str;

class ApiUtil
{

    public static function generateSmsCode(): string
    {
        $min = pow(10, 3);
        $max = pow(10, 4) - 1;
        return rand($min, $max);
    }

    public static function sendAuthSms(string $phone, string $code)
    {
        $data = array
        (
            'recipient' => $phone,
            'text' => 'Код авторизации TAKON: ' . $code,
            'apiKey' => 'b60ce3cf8697fa6d2ef145c429eea815128dc7ca'
        );
    }

    public static function generateToken() : string {
    	return Str::random(42);
    }

}