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
use App\Jobs\SendMassPush;
use App\Jobs\SendPush;
use App\JobTemplates\MassPushJobTemplate;
use App\JobTemplates\PushJobTemplate;
use App\Models\Profiles\User;
use App\Queues\QueueConstants;
use App\Services\v1\PushService;
use App\Utils\StaticConstants;
use Illuminate\Support\Facades\DB;

class PushServiceImpl implements PushService
{
    public function sendPush(User $user, Pushable $pushable)
    {
        FireBase::sendPush($pushable, $user);
    }

    public function sendPushByPushJob(PushJobTemplate $pushJobTemplate)
    {
        $this->sendPush(
            $pushJobTemplate->getUser(),
            $pushJobTemplate->getPushable()
        );
    }

    public function passGeneralPushToQueue(User $user, $title, $description)
    {
        $generalPush = new GeneralPush($title, $description);
        $pushJobTemplate = new PushJobTemplate($user, $generalPush);
        SendPush::dispatch($pushJobTemplate)
            ->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
    }

    public function passGeneralPushToMassQueue(Array $users, $title, $description, $platform)
    {
        $generalPush = new GeneralPush($title, $description);
        $pushJobTemplate = new MassPushJobTemplate($users, $generalPush, $platform);
        SendMassPush::dispatch($pushJobTemplate)
            ->onQueue(QueueConstants::MASS_PUSH_QUEUE);
    }

    public function sendMassPushByPushJobTemplate(MassPushJobTemplate $pushJobTemplate)
    {
        $this->sendMassPush(
            $pushJobTemplate->getUsers(),
            $pushJobTemplate->getPlatform(),
            $pushJobTemplate->getPushable()
        );
    }

    public function sendMassPush(Array $users, $platform, Pushable $pushable)
    {
        FireBase::sendMassPush($pushable, $users, $platform);
    }

    public function startMassPush($type, $title, $description)
    {
        switch ($type) {
            case StaticConstants::ALL_TYPE:
                {
                    User::whereNotNull('device_token')
                        ->where('platform', User::PLATFORM_ANDROID)
                        ->orderBy('id', 'desc')
                        ->chunk(900, function ($users) use ($title, $description) {
                            $userDeviceTokens = $users->pluck('device_token')->toArray();
                            $this->passGeneralPushToMassQueue(
                                $userDeviceTokens,
                                $title,
                                $description,
                                User::PLATFORM_ANDROID
                            );
                        });

                    User::whereNotNull('device_token')
                        ->where('platform', User::PLATFORM_IOS)
                        ->orderBy('id', 'desc')
                        ->chunk(900, function ($users) use ($title, $description) {
                            $userDeviceTokens = $users->pluck('device_token')->toArray();
                            $this->passGeneralPushToMassQueue(
                                $userDeviceTokens,
                                $title,
                                $description,
                                User::PLATFORM_IOS
                            );
                        });
                    break;
                }
            case StaticConstants::NOT_PAID_TYPE:
                {
                    DB::table('users as u')
                        ->select(['u.*'])
                        ->leftJoin('subscriptions as s', 's.user_id', '=', 'u.id')
                        ->where(function ($query) {
                            $query->whereNull('s.id')
                                ->orWhereRaw('now() > s.expired_a');
                        })
                        ->where('u.device_token')
                        ->orderBy('u.id', 'desc')
                        ->where('u.platform', '=', User::PLATFORM_IOS)
                        ->chunk(900, function ($users) use ($title, $description) {
                            $userDeviceTokens = $users->pluck('device_token')->toArray();
                            $this->passGeneralPushToMassQueue(
                                $userDeviceTokens,
                                $title,
                                $description,
                                User::PLATFORM_IOS
                            );
                        });

                    DB::table('users as u')
                        ->select(['u.*'])
                        ->leftJoin('subscriptions as s', 's.user_id', '=', 'u.id')
                        ->where(function ($query) {
                            $query->whereNull('s.id')
                                ->orWhereRaw('now() > s.expired_a');
                        })
                        ->where('u.device_token')
                        ->orderBy('u.id', 'desc')
                        ->where('u.platform', '=', User::PLATFORM_ANDROID)
                        ->chunk(900, function ($users) use ($title, $description) {
                            $userDeviceTokens = $users->pluck('device_token')->toArray();
                            $this->passGeneralPushToMassQueue(
                                $userDeviceTokens,
                                $title,
                                $description,
                                User::PLATFORM_ANDROID
                            );
                        });
                    break;
                }
        }
    }


}