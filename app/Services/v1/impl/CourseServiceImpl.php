<?php


namespace App\Services\v1\impl;


use App\Models\Courses\Course;
use App\Services\v1\CourseService;

class CourseServiceImpl implements CourseService
{
    public function findAll($perPage)
    {
        return Course::paginate($perPage);
    }
}
