<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Categories\RecommendedCategory;
use App\Models\Courses\Course;

use App\Models\Courses\CourseMaterial;
use App\Models\Education\Passing;
use App\Services\v1\CourseService;
use Illuminate\Support\Facades\DB;
use Auth;
use PHPUnit\Framework\Constraint\IsTrue;

class CourseServiceImpl implements CourseService
{
    public function findAll($perPage,$title)
    {
        if(!$title) return Course::where('is_visible',True)->paginate($perPage);
        return Course::where('title', 'like', '%' . $title . '%')
            ->where('is_visible',True)
            ->paginate($perPage);
    }

    public function findUserCourses($perPage, $userId)
    {
        $user = Auth::user();
        $courses = DB::table('courses as c')
            ->distinct()
            ->select('c.*')
            ->join('course_materials as cm', 'cm.course_id', '=', 'c.id')
            ->join('passings as p', 'p.course_material_id', '=', 'cm.id')
            ->where('p.user_id', $user->id)
            ->paginate($perPage);
//        $passings = Passing::where('user_id', $users->id)->get();
//        if(!$passings) return [];

        $courses= Course::hydrate($courses->items());
        foreach ($courses as $course) {
             $course->lessons_count = $course->materials->count();
             $count = 0;
             foreach ($course->materials as $material) {
                 $passing = Passing::where('course_material_id', $material->id)->where('user_id', $user->id)->first();
                 if($passing) {
                     $count++;
                 }
             }
             $course->lessons_passing_count = $count;
             $course->makeHidden('materials');
        }
        return $courses;
    }

    public function findByCategory($categoryId, $size)
    {
        return Course::where('category_id', $categoryId)->where('is_visible', true)
            ->paginate($size);
    }

    public function findById($id)
    {
        $course = Course::find($id);
        if(!$course) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого курса не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $courseMaterials = array();
        $materials = CourseMaterial::where('course_id', $course->id)->orderBy('ordering')->get();
        if($materials) {
            foreach ($materials as $material) {
                $courseMaterials[] = array('id' => $material->id, 'title' => $material->title);
            }
        }
        $course->materials = $courseMaterials;

        return $course;
    }

    public function forMe($size)
    {
        $user = Auth::user();
        return $user->forMe($size);
    }


}
