<?php


namespace App\Services\v1\impl;


use App\CloudMessaging\Pushes\GeneralPush;
use App\Jobs\SendPush;
use App\JobTemplates\PushJobTemplate;
use App\Models\Profiles\Level;
use App\Models\Profiles\User;
use App\Models\Subscriptions\FollowSubscription;
use App\Queues\QueueConstants;
use App\Services\v1\LevelService;
use Auth;

class LevelServiceImpl implements LevelService
{
    public function checkLevel($followerUserId, $hostUserId, $subscriptionId, $levelId)
    {
        $subscribe = FollowSubscription::where('follower_user_id', $followerUserId)
            ->where('host_user_id', $hostUserId)->first();
        if(!$subscribe) {
            FollowSubscription::create([
                'follower_user_id' => $followerUserId,
                'host_user_id' => $hostUserId,
                'level_id' => $levelId,
                'subscription_id' => $subscriptionId
            ]);
            $followSubscriptionsCount = FollowSubscription::where('host_user_id', $hostUserId)->where('level_id', $levelId)->count();
            $level = Level::find($levelId);
            if($level) {
                if($level->end_count - $level->start_count == $followSubscriptionsCount) {
                    $nextLevel = Level::where('start_count', $level->end_count)->first();
                    $user = User::find($hostUserId);
                    if($user && $nextLevel) {
                        $user->level_id = $nextLevel->id;
                        $user->save();
                            $generalPush = new GeneralPush($user->surname . ' ' . $user->name . ' құтты болсын!👏🏻',
                                'Сіз ' . $nextLevel->name . ' деңгейіне өттіңіз👍🏻.' . "\r\n" . 'Енді cіздің әр сатылымнан табысыңыз ' .
                                $nextLevel->discount_percentage . '% құрайды.');
                            $pushJobTemplate = new PushJobTemplate($user, $generalPush);
                            SendPush::dispatch($pushJobTemplate)->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
                    }
                }
            }
        }
    }

}
