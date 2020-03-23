<?php


namespace App\Services\v1;


interface RatingService
{
    public function evaluate($course_id, $scale);

    public function evaluateMeditation($meditation_id, $scale);

    public function userRating();

    public function specificUserRating($userId);
}
