<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 19:53
 */

namespace App\JobTemplates;


class SmsJobTemplate
{
    private $phone;
    private $message;

    /**
     * SmsJobTemplate constructor.
     * @param $phone
     * @param $message
     */
    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


}