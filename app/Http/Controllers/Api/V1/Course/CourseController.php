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

        $title = $request->title ? $request->title : null;

        $courses = $this->courseService->findAll($perPage,$title);

        return $this->successResponse(['courses' => $courses]);

    }

    public function getUserCourses(Request $request)
    {
        $perPage = $request->size ? $request->size : 10;
        $userId = $request->user_id;
        $courses = $this->courseService->findUserCourses($perPage,$userId);

        return $this->successResponse(['courses' => $courses]);
    }

    public function getCoursesByCategory($categoryId, Request $request) {
        $size = $request->size ? $request->size : 10;
        $courses = $this->courseService->findByCategory($categoryId, $size);
        return $this->successResponse(['courses' => $courses]);
    }

    public function getById($id) {
        return $this->successResponse(['course' => $this->courseService->findById($id)]);
    }

    public function coursesForMe(Request $request) {
        return $this->successResponse(['courses' => $this->courseService->forMe($request->size)]);
    }

    public function certificate($id) {
        return $this->courseService->getCertificate($id);
    }

    public function certificateUrl($id) {
        return $this->successResponse(['url' => 'https://tensend.me/api/v1/courses/certificate/'.$id]);
    }


}
