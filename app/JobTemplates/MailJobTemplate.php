<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 19:50
 */

namespace App\JobTemplates;


class MailJobTemplate
{
    private $to;
    protected $message;
    protected $title;

    /**
     * MailJobTemplate constructor.
     * @param $to
     * @param $message
     * @param $title
     */
    public function __construct($to, $message, $title = null)
    {
        $this->to = $to;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

}