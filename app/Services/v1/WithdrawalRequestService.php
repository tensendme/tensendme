<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:05
 */

namespace App\Services\v1;


interface WithdrawalRequestService
{
    public function withdrawalRequest($amount, $comment);
    public function approve($id);
    public  function cancel($id);

}
