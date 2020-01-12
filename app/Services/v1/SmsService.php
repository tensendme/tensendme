<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:57
 */

namespace App\Services\v1;


interface SmsService
{
    public function sendMessage($phone, $code);
}