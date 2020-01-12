<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:51
 */

namespace App\Services\v1;


interface CodeService
{
    public function createAndSendCode($phone);

    public function checkCode($phone, $code) :bool ;
}