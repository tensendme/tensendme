<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Courses\CourseMaterial;
use App\Models\Education\Passing;
use App\Services\v1\PassingService;
use Auth;

class PassingServiceImpl implements PassingService
{
    public function pass($courseMaterialId)
    {
        $user = Auth::user();
        $material = CourseMaterial::find($courseMaterialId);
        if(!$material) throw new ApiServiceException(404, false, [
                'errors' => [
                    'Урок не найден'
                ],
                'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
            ]);
        $passing = Passing::where('course_material_id', $courseMaterialId)->where('user_id', $user->id)->first();
        if($passing) return "Урок уже успешно просмотрен";

        Passing::create([
            'course_material_id' => $courseMaterialId,
            'user_id' => $user->id
        ]);

        $material->view_count = $material->view_count + 1;
        $material->save();

        $course = $material->course;
        $course->view_count = $course->view_count + 1;
        $course->save();
        return "Урок успешно просмотрен";
    }

}
