<?php

namespace App\Http\Controllers\Api\V1\Course;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Api\V1\PassingRequest;
use App\Services\v1\PassingService;
use Illuminate\Http\Request;

class PassingController extends ApiBaseController
{
    protected $passingService;

    public function __construct(PassingService $passingService)
    {
        $this->passingService = $passingService;
    }

    public function passCourseLesson(PassingRequest $request) {
        return $this->successResponse(['message' => $this->passingService->pass($request->lessonId)]);
    }

    public function startCourse() {
//        return $this->successResponse(['message' => $this->passingService->pass($request->courseId)]);
    }

}
