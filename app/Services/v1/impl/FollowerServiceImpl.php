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
use App\Models\Subscriptions\PromoCodeAnalytic;
use App\Services\v1\FollowerService;
use App\Services\v1\HistoryService;
use App\Services\v1\PromoCodeAnalyticService;
use Auth;
use DateTime;

class FollowerServiceImpl implements FollowerService
{
    protected $historyService;
    protected $promoCodeAnalyticService;
    public function __construct(HistoryService $historyService,
                                PromoCodeAnalyticService $promoCodeAnalyticService)
    {
        $this->historyService = $historyService;
        $this->promoCodeAnalyticService = $promoCodeAnalyticService;
    }

    public function follow($promoCode)
    {
        $followerUser = Auth::user();
        $hostUser = User::where('promo_code', $promoCode)->first();
        if (!$hostUser) throw new ApiServiceException(404, false, [
            'errors' => ['Не найден промо-код'],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND]);
        if($followerUser->id == $hostUser->id) {
            throw new ApiServiceException(401, false, [
                'errors' => ['Собственный промо-код невозможно подписать'],
                'errorCode' => ErrorCode::INVALID_ARGUMENT]);
        }
        $follower = Follower::where('follower_user_id', $followerUser->id)->first();
        if ($follower) throw new ApiServiceException(400, false, [
            'errors' => ['У вас уже существует подписка'],
            'errorCode' => ErrorCode::ALREADY_EXISTS]);

        $level = $hostUser->level;

        $follower = Follower::create([
            'follower_user_id' => $followerUser->id,
            'host_user_id' => $hostUser->id,
            'level_id' => $level->id
        ]);
//        $this->historyService->follower($follower);

//        $date = new DateTime();
//        $date->modify('-' . $level->period_date . 'days');
//        $followers = $hostUser->followers;
//        $followersCount = $followers->where('level_id', $level->id)->where('created_at', '>', $date)->count();
//        if ($followersCount == $level->end_count) {
//            $level = Level::where('start_count', $level->end_count)->first();
//            if ($level) {
//                $hostUser->level_id = $level->id;
//                $hostUser->save();
//                // Congratulations Push
//            }
//        }

        $this->promoCodeAnalyticService->makeInstalled($hostUser->id, $hostUser->promo_code, $followerUser->id);
        return "Промо код принят успешно!";
    }

    public function promoFollow($phone, $userId)
    {
        $promoCode = PromoCodeAnalytic::where('type', PromoCodeAnalytic::TYPE_PASSED)
            ->where('phone', $phone)->first();
        if(!$promoCode) return 0;
        $hostUser = $promoCode->hostUser;
        Follower::create([
            'follower_user_id' => $userId,
            'host_user_id' => $hostUser->id,
            'level_id' => 1,
        ]);
        $this->promoCodeAnalyticService->makeInstalled($hostUser->id, $hostUser->promo_code, $userId);
        return 1;
    }


}
