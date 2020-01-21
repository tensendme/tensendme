<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 21.01.2020
 * Time: 22:20
 */

namespace App\Services\v1;


interface MailService
{
    public function sendEmail($to, string $message, $title = null);
}