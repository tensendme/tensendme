<?php


namespace App\Http\Utils;


use Carbon\Carbon;
use Illuminate\Support\Str;
use JWTAuth;

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

    public static function generateToken(): string
    {
        return Str::random(42);
    }

    public static function generateTokenFromUser($user): string
    {
        if ($user->current_token) {
            $auth = JWTAuth::setToken($user->current_token);
            $auth->invalidate();
        }
        $expiration_date = Carbon::now()->addDays(7)->timestamp;
        $customClaims = ['exp' => $expiration_date];
        return JWTAuth::fromUser($user, $customClaims);
    }

}