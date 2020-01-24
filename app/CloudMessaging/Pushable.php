<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.01.2020
 * Time: 03:44
 */

namespace App\CloudMessaging;


interface Pushable
{

    public function toIOS();

    public function toAndroid();

}