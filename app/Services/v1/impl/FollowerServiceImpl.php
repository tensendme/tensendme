<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Histories\Follower;
use App\Models\Profiles\Level;
use App\Models\Profiles\User;
use App\Services\v1\FollowerService;
use App\Services\v1\HistoryService;
use Auth;
use DateTime;

class FollowerServiceImpl implements FollowerService
{
    protected $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }
    public function follow($promoCode)
    {
        $followerUser = Auth::user();
        $hostUser = User::where('promo_code', $promoCode)->first();
        if(!$hostUser) throw new ApiServiceException(404, false, [
            'errors' => ['Не найден промо-код'],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND]);
        $follower = Follower::where('follower_user_id', $followerUser->id)->where('host_user_id', $hostUser->id)->first();
        if($follower) throw new ApiServiceException(400, false, [
            'errors' => ['Существующая подписка'],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND]);
        $follower = Follower::create([
            'follower_user_id' => $followerUser->id,
            'host_user_id' => $hostUser->id
        ]);
        $this->historyService->follower($follower);
        $date = new DateTime();
        $date->modify('-' . 21 . 'days');
        //$level->time должно быть вместо статичной времени
        $followers = $hostUser->followers;
        $level = $hostUser->level;
        $followersCount = $followers->where('created_at', '>', $date)->count();
        if($followersCount == $level->end_count) {
            $level = Level::where('start_count', $level->end_count)->first();
            if($level) {
                $hostUser->level_id = $level->id;
                $hostUser->save();
                // Congratulations Push
            }
        }
        return "Промо код принят успешно!";
    }

}
