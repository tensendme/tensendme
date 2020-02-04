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
use App\Models\Rating;
use App\Services\v1\RatingService;
use Auth;

class RatingServiceImpl implements RatingService
{
    public function evaluate($course_id, $scale)
    {
        $course = Course::find($course_id);
        if(!$course) throw new ApiServiceException(404, false, [
            'errors' => [
                'Курс не найден!'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $user = Auth::user();
        $rating = Rating::where('user_id', $user->id)->where('course_id', $course->id)->first();
        if(!$rating)
            $rating = Rating::updateOrCreate([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'scale' => $scale
            ]);
        else $rating->scale = $scale;
        $rating->save();
        $courseRatings = Rating::where('course_id', $course->id);
        $courseScale = $courseRatings->get()->sum('scale')/$courseRatings->count();
        $course->scale = $courseScale;
        $course->save();
        return "Спасибо за вашу оценку!";

    }


}
