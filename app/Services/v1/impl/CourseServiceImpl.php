<?php


namespace App\Services\v1\impl;


use App\Http\Errors\ErrorCode;
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
//        $passings = Passing::where('user_id', $user->id)->get();
//        if(!$passings) return [];


        return $courses;
    }



}
