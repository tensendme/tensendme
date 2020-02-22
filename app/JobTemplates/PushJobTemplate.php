<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 20:01
 */

namespace App\JobTemplates;


use App\CloudMessaging\Pushable;
use App\Models\Profiles\User;

class PushJobTemplate
{
    private $user;
    private $pushable;

    /**
     * PushJobTemplate constructor.
     * @param $user
     * @param $pushable
     */
    public function __construct(User $user, Pushable $pushable)
    {
        $this->user = $user;
        $this->pushable = $pushable;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Pushable
     */
    public function getPushable(): Pushable
    {
        return $this->pushable;
    }



}