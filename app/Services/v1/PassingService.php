<?php


namespace App\Services\v1;


interface PassingService
{
    public function pass($courseMaterialId);
    public function startCourse($courseId);
}
