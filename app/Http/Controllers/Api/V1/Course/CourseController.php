<?php

namespace App\Http\Controllers\Api\V1\Course;


use Illuminate\Http\Request;

use App\Services\v1\CourseService;
use App\Http\Controllers\ApiBaseController;


class CourseController extends ApiBaseController
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function getAllCourses(Request $request)
    {
        $perPage = $request->size ? $request->size : 10;

        $courses = $this->courseService->findAll($perPage);

        return $this->successResponse(['courses' => $courses]);

    }
}
