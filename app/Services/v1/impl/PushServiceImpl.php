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
use App\CloudMessaging\Pushes\GeneralPush;
use App\Jobs\SendPush;
use App\JobTemplates\PushJobTemplate;
use App\Models\Profiles\User;
use App\Queues\QueueConstants;
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

    public function passGeneralPushToQueue(User $user, $title, $description)
    {
        $generalPush = new GeneralPush($title, $description);
        $pushJobTemplate = new PushJobTemplate($user, $generalPush);
        SendPush::dispatch($pushJobTemplate)->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
    }


}