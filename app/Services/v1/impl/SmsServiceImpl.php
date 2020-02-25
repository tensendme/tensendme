<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:57
 */

namespace App\Services\v1\impl;


use App\JobTemplates\SmsJobTemplate;
use App\Services\v1\SmsService;

class SmsServiceImpl implements SmsService
{

    public function sendSms($phone, $message)
    {
        $login = 'Tensend';
        $password = 'tensendkz';
        return file_get_contents("https://smsc.kz/sys/send.php?login=$login&psw=$password&phones=$phone&mes=$message");
    }

    public function sendSmsBySmsJob(SmsJobTemplate $smsJobTemplate)
    {
        $this->sendSms($smsJobTemplate->getPhone(), $smsJobTemplate->getMessage());
    }


}