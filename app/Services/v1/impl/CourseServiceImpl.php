<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Courses\Course;

use App\Models\Education\Passing;
use App\Models\Education\UserCourse;
use App\Models\Profiles\Certificate;
use App\Models\Rating;
use App\Services\v1\CourseService;
use Illuminate\Support\Facades\DB;
use Auth;

class CourseServiceImpl implements CourseService
{
    public function findAll($perPage,$title)
    {

        $user = Auth::user();

        if(!$title) $courses =  Course::where('is_visible',true)
            ->with('author')
            ->with('lessons')
            ->orderBy('scale', 'desc')
            ->paginate($perPage);
         else $courses =  Course::where('title', 'like', '%' . $title . '%')
            ->where('is_visible',true)
            ->with('author')
            ->with('lessons')
            ->orderBy('scale', 'desc')
            ->paginate($perPage);

        $coursesItems = $courses->getCollection();
        $startedCourse = UserCourse::whereIn('course_id', $coursesItems->pluck('id'))->where('user_id', $user->id)->get();
        foreach ($coursesItems as $course) {
            $courseMaterials = $course->lessons;
            $course->lessons_count = $courseMaterials->count();
            if($user) $count = Passing::whereIn('course_material_id', $courseMaterials->pluck('id'))->where('user_id', $user->id)->count();
            $course->information_list = array_filter(explode(',', $course->information_list));
            $course->lessons_passing_count = $count;
            $started = $startedCourse->where('course_id', $course->id)->first();
            $course->started = $started ? true : false;
            $course->makeHidden('lessons');
        }

        $courses->setCollection($coursesItems);
        return $courses;
    }

    public function findUserCourses($perPage, $userId)
    {
        $user = Auth::user();
//        $courses = DB::table('courses as c')
//            ->distinct()
//            ->select('c.*')
//            ->join('course_materials as cm', 'cm.course_id', '=', 'c.id')
//            ->join('passings as p', 'p.course_material_id', '=', 'cm.id')
//            ->where('p.user_id', $user->id)
//            ->orderBy('c.scale', 'desc')
//            ->paginate($perPage);

        $userCourses = UserCourse::where('user_id', $user->id)->get();
        $courses = Course::whereIn('id', $userCourses->pluck('course_id'))->where('is_visible', true)
            ->with('author')
            ->with('lessons')
            ->orderBy('scale', 'desc')
            ->paginate($perPage);

        $coursesItems = $courses->getCollection();

        foreach ($coursesItems as $course) {
            $courseMaterials = $course->lessons;
            $course->lessons_count = $courseMaterials->count();
            $course->information_list = array_filter(explode(',', $course->information_list));
            $count = Passing::whereIn('course_material_id', $courseMaterials->pluck('id'))
                ->where('user_id', $user->id)->count();
            $course->lessons_passing_count = $count;
            $course->started = true;
            $course->makeHidden('lessons');
        }
        $courses->setCollection($coursesItems);
        return $courses;
    }

    public function findByCategory($categoryId, $size)
    {
        $user = Auth::user();
        $courses =  Course::where('category_id', $categoryId)
            ->where('is_visible', true)
            ->with('author')
            ->with('lessons')
            ->orderBy('scale', 'desc')
            ->paginate($size);

        $coursesItems = $courses->getCollection();
        $startedCourse = UserCourse::whereIn('course_id', $coursesItems->pluck('id'))->where('user_id', $user->id)->get();
        foreach ($coursesItems as $course) {
            $courseMaterials = $course->lessons;
            $course->lessons_count = $courseMaterials->count();
            $count = Passing::whereIn('course_material_id', $courseMaterials->pluck('id'))->where('user_id', $user->id)->count();
            $course->information_list = array_filter(explode(',', $course->information_list));
            $course->lessons_passing_count = $count;
            $started = $startedCourse->where('course_id', $course->id)->first();
            $course->started = $started ? true : false;
            $course->makeHidden('lessons');
        }

        $courses->setCollection($coursesItems);
        return $courses;
    }

    public function findById($id)
    {
        $course = Course::where('id', $id)->where('is_visible', true)
            ->with('author')
            ->with('lessons')
            ->first();
        if(!$course) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого курса не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $user = Auth::user();
        $startedCourse = UserCourse::where('course_id', $course->id)->where('user_id', $user->id)->first();
        $subscriptions = $user->activeSubscriptions();
        $course->access = $subscriptions->exists() ? true : false;
        $course->lessons_count = $course->lessons->count();
        $course->information_list = array_filter(explode(',', $course->information_list));
        $passed = Passing::whereIn('course_material_id', $course->lessons->pluck('id'))->where('user_id', $user->id);
        $isRated = Rating::where('course_id', $course->id)->where('user_id', $user->id)->first();
        $course->lessons_passing_count = $passed->count();
        $course->started = $startedCourse ? true : false;
        $course->isRated = $isRated ? true :false;
        foreach ($course->lessons as $lesson) {
            $lesson->access = $subscriptions->exists() || $lesson->free ? true : false;
            $lesson->passed = $passed->get()->where('course_material_id', $lesson->id)->first() ? true : false;
        }

        return $course;
    }

    public function forMe($size)
    {
        $user = Auth::user();
        return $user->forMe($size);
    }

    public function getCertificate($courseId)
    {
        $user = Auth::user();
        $courseSertificate = Certificate::where('user_id', $user->id)->where('course_id', $courseId)
            ->with('course.author')
            ->first();
        if(!$courseSertificate) return view('welcome');
        if(!$courseSertificate->father_name) $courseSertificate->father_name = $user->father_name;
        if(!$courseSertificate->surname) $courseSertificate->surname = $user->surname;
        if(!$courseSertificate->name) $courseSertificate->name = $user->name;
        $courseSertificate->save();

        if(!$courseSertificate) return view('welcome');
        $certificate = 'Сертификат';
        $id = 'ID #'.$courseSertificate->id;
        $middleText = 'об участии на курсе «'. $courseSertificate->course->title .'»';
        $author = $courseSertificate->course->author ? 'Автор курса: '.
            $courseSertificate->course->author->surname . ' '.$courseSertificate->course->author->name . ' '
            .$courseSertificate->course->author->father_name: 'Автор курса: Tensend';
        $given = 'ВЫДАЕТСЯ';
        $fullName = $courseSertificate->name. ' '. $courseSertificate->surname. ' '. $courseSertificate->father_name;
        $infoText = 'Сайт рыбатекст поможет дизайнеру,
                верстальщику, вебмастеру сгенерировать
                несколько абзацев более менее
                осмысленного текста рыбы на русском языке';
        return view('pdf_view', compact('certificate', 'middleText', 'given',
            'fullName', 'infoText', 'author', 'id'));
    }
}
