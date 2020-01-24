<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 17:22
 */

namespace App\CloudMessaging;


class PushType
{

    public const GENERAL_PUSH = 0;
    public const PUSH_CHAT_MESSAGE = 1;
    public const PUSH_SEND_LOCATION = 2;
    public const PUSH_GET_LOCATION = 3;

}