<?php


namespace App\Services\v1;


interface RatingService
{
    public function evaluate($course_id, $scale);
}
