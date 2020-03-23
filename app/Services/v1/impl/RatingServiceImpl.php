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
use App\Models\Courses\Course;
use App\Models\Meditations\Meditation;
use App\Models\Meditations\MeditationRating;
use App\Models\Profiles\Role;
use App\Models\Rating;
use App\Models\Subscriptions\PromoCodeAnalytic;
use App\Services\v1\RatingService;
use Auth;
use Illuminate\Support\Facades\DB;

class RatingServiceImpl implements RatingService
{
    public function evaluate($course_id, $scale)
    {
        $course = Course::find($course_id);
        if (!$course) throw new ApiServiceException(404, false, [
            'errors' => [
                'Курс не найден!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $user = Auth::user();
        $rating = Rating::where('user_id', $user->id)->where('course_id', $course->id)->first();
        if (!$rating)
            $rating = Rating::updateOrCreate([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'scale' => $scale
            ]);
        else $rating->scale = $scale;
        $rating->save();
        $courseRatings = Rating::where('course_id', $course->id);
        $courseScale = $courseRatings->get()->sum('scale') / $courseRatings->count();
        $course->scale = $courseScale;
        $course->save();
        return "Спасибо за вашу оценку!";

    }

    public function evaluateMeditation($meditationId, $scale)
    {
        $meditation = Meditation::find($meditationId);
        if (!$meditation) throw new ApiServiceException(404, false, [
            'errors' => [
                'Медитация не найденa!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $user = Auth::user();
        $rating = MeditationRating::where('user_id', $user->id)->where('meditation_id', $meditation->id)->first();
        if (!$rating)
            $rating = MeditationRating::updateOrCreate([
                'user_id' => $user->id,
                'meditation_id' => $meditation->id,
                'scale' => $scale
            ]);
        else $rating->scale = $scale;
        $rating->save();
        $meditationRatings = MeditationRating::where('meditation_id', $meditation->id);
        $meditationScale = $meditationRatings->get()->sum('scale') / $meditationRatings->count();
        $meditation->scale = $meditationScale;
        $meditation->save();
        return "Спасибо за вашу оценку!";

    }


    public function userRating()
    {
        $purchasedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_PURCHASED)
            ->groupBy('host_user_id');

        $installedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_INSTALLED)
            ->groupBy('host_user_id');

        $passedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_PASSED)
            ->groupBy('host_user_id');

        $cameJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_CAME)
            ->groupBy('host_user_id');

        return DB::table('users as u')
            ->select([
                'u.id',
                'u.name',
                'u.surname',
                'u.father_name',
                'u.image_path',
                'u.level_id',
                'l.logo',
                DB::raw('case when ISNULL(purchased.count) then 0 else purchased.count end as rating'),
//                DB::raw('case when ISNULL(installed.count) then 0 else installed.count end as installed'),
//                DB::raw('case when ISNULL(passed.count) then 0 else passed.count end as passed'),
            ])
            ->leftJoinSub($purchasedJoinSub, 'purchased',
                'purchased.host_user_id', '=', 'u.id')
            ->leftJoinSub($installedJoinSub, 'installed',
                'installed.host_user_id', '=', 'u.id')
            ->leftJoinSub($passedJoinSub, 'passed',
                'passed.host_user_id', '=', 'u.id')
            ->leftJoinSub($cameJoinSub, 'came',
                'came.host_user_id', '=', 'u.id')
            ->leftJoin('levels as l', 'u.level_id', 'l.id')
            ->whereIn('u.role_id', [Role::USER_ID, Role::AUTHOR_ID])
            ->orderBy('purchased.count', 'desc')
            ->orderBy('installed.count', 'desc')
            ->orderBy('passed.count', 'desc')
            ->orderBy('came.count', 'desc')
            ->limit(10)
            ->get();
    }

    public function specificUserRating($userId)
    {
        $purchasedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_PURCHASED)
            ->groupBy('host_user_id');

        $installedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_INSTALLED)
            ->groupBy('host_user_id');

        $passedJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_PASSED)
            ->groupBy('host_user_id');

        $cameJoinSub = DB::table('promo_code_analytics')
            ->select([DB::raw('count(*) as count'), 'host_user_id'])
            ->where('type', PromoCodeAnalytic::TYPE_CAME)
            ->groupBy('host_user_id');

        return DB::table('users as u')
            ->select([
                'u.id',
                'u.name',
                'u.surname',
                'u.father_name',
                'u.image_path',
                'u.level_id',
                'l.logo',
                DB::raw('case when ISNULL(purchased.count) then 0 else purchased.count end as purchased'),
                DB::raw('case when ISNULL(installed.count) then 0 else installed.count end as installed'),
                DB::raw('case when ISNULL(passed.count) then 0 else passed.count end as passed'),
                DB::raw('case when ISNULL(came.count) then 0 else came.count end as came'),
            ])
            ->leftJoinSub($purchasedJoinSub, 'purchased',
                'purchased.host_user_id', '=', 'u.id')
            ->leftJoinSub($installedJoinSub, 'installed',
                'installed.host_user_id', '=', 'u.id')
            ->leftJoinSub($passedJoinSub, 'passed',
                'passed.host_user_id', '=', 'u.id')
            ->leftJoinSub($cameJoinSub, 'came',
                'came.host_user_id', '=', 'u.id')
            ->leftJoin('levels as l', 'u.level_id', 'l.id')
            ->whereIn('u.role_id', [Role::USER_ID, Role::AUTHOR_ID])
            ->orderBy('purchased.count', 'desc')
            ->orderBy('installed.count', 'desc')
            ->orderBy('passed.count', 'desc')
            ->orderBy('came.count', 'desc')
            ->where('u.id', $userId)
            ->first();
    }


}
