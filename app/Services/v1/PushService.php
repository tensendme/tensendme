<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 20:34
 */

namespace App\Services\v1;


use App\CloudMessaging\Pushable;
use App\JobTemplates\MassPushJobTemplate;
use App\JobTemplates\PushJobTemplate;
use App\Models\Profiles\User;

interface PushService
{
    public function sendPush(User $user, Pushable $pushable);

    public function sendPushByPushJob(PushJobTemplate $pushJobTemplate);

    public function passGeneralPushToQueue(User $user, $title, $description);

    public function sendMassPushByPushJobTemplate(MassPushJobTemplate $pushJobTemplate);

    public function sendMassPush(Array $users, $platform, Pushable $pushable);

    public function passGeneralPushToMassQueue(Array $users, $title, $description, $platform);

    public function startMassPush($type, $title, $description);
}