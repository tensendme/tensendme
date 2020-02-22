<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 20:34
 */

namespace App\Services\v1\impl;


use App\CloudMessaging\FireBase;
use App\CloudMessaging\Pushable;
use App\JobTemplates\PushJobTemplate;
use App\Models\Profiles\User;
use App\Services\v1\PushService;

class PushServiceImpl implements PushService
{
    public function sendPush(User $user, Pushable $pushable)
    {
        FireBase::sendPush($pushable, $user);
    }

    public function sendPushByPushJob(PushJobTemplate $pushJobTemplate)
    {
        $this->sendPush($pushJobTemplate->getUser(), $pushJobTemplate->getPushable());
    }

}