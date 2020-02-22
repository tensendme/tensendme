<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:57
 */

namespace App\Services\v1;


use App\JobTemplates\SmsJobTemplate;

interface SmsService
{
    public function sendSms($phone, $message);

    public function sendSmsBySmsJob(SmsJobTemplate $smsJobTemplate);
}