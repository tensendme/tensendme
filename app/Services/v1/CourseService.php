<?php


namespace App\Services\v1;


interface CourseService
{
    public function findAll($perPage,$title);
    public function findUserCourses($perPage,$userId);




}
