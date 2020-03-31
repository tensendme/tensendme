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

class MassPushJobTemplate
{
    private $users;
    private $pushable;
    protected $platform;

    /**
     * MassPushJobTemplate constructor.
     * @param $users
     * @param $pushable
     * @param $platform
     */
    public function __construct(Array $users, Pushable $pushable, string $platform)
    {
        $this->users = $users;
        $this->pushable = $pushable;
        $this->platform = $platform;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @return Pushable
     */
    public function getPushable(): Pushable
    {
        return $this->pushable;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * PushJobTemplate constructor.
     * @param $user
     * @param $pushable
     */


}