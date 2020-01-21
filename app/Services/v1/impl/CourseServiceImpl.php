<?php


namespace App\Services\v1\impl;


use App\Models\Courses\Course;

use App\Models\Courses\CourseMaterial;
use App\Models\Education\Passing;
use App\Services\v1\CourseService;
use Illuminate\Support\Facades\DB;

class CourseServiceImpl implements CourseService
{
    public function findAll($perPage)
    {
        return Course::paginate($perPage);
    }

    public function findUserCourses($perPage, $userId)
    {

        $courses = DB::table('courses as c')
            ->distinct()
            ->select('c.*')
            ->join('course_materials as cm', 'cm.course_id', '=', 'c.id')
            ->join('passings as p', 'p.course_material_id', '=', 'cm.id')
            ->where('p.user_id', $userId)
            ->paginate($perPage);

        return $courses;
    }

}
