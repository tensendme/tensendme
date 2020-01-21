<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:57
 */

namespace App\Services\v1\impl;


use App\Services\v1\SmsService;

class SmsServiceImpl implements SmsService
{

    public function sendMessage($phone, $code)
    {
        $login = 'ayrinonline';
        $password = 'sabyrzhanayrin0013392004';
        $message = "Tensend.me: $code";
        return file_get_contents("https://smsc.kz/sys/send.php?login=$login&psw=$password&phones=$phone&mes=$message");
    }

}