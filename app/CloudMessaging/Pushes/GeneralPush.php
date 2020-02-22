<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 17:22
 */

namespace App\CloudMessaging\Pushes;


use App\CloudMessaging\Pushable;
use App\CloudMessaging\PushType;

class GeneralPush implements Pushable
{
    public $type = PushType::GENERAL_PUSH;
    public $image_url;
    public $title;
    public $description;

    public function __construct($title, $description, $image_url = null)
    {
        $this->image_url = $image_url;
        $this->title = $title;
        $this->description = $description;
    }


    public function toIOS()
    {
        return [
            'content_available' => true,
            'notification' => [
                "content_available" => true,
                "priority" => "high",
                "title" => $this->title,
                "body" => $this->description,
                "mutable-content" => 1,
                "sound" => "",
                "type" => $this->type,
                "image_url" => $this->image_url,
            ]
        ];
    }

    public function toAndroid()
    {
        return [
            'data' => [
                "type" => $this->type,
                "image_url" => $this->image_url,
                "title" => $this->title,
                "description" => $this->description,
            ]
        ];
    }


}
