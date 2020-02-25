<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseControllerRequests\CourseStoreAndUpdateRequest;
use App\Models\Categories\Category;
use App\Models\Courses\Course;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use Mockery\Exception;

class CourseController extends WebBaseController
{

    protected $fileService;

    /**
     * CourseController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function index()
    {
        $courses = Course::with(['author', 'lessons'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::where('category_type_id', 1)
            ->doesntHave('childrens')
            ->get();
        $course = new Course();
        if(!empty($course)) $course = null;
        return view('admin.course.create', compact('categories', 'course'));
    }

    public function store(CourseStoreAndUpdateRequest $request)
    {
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('image')) {
            $path = $this->fileService->store($request->file('image'), Course::DEFAULT_RESOURCE_DIRECTORY);
        }
        if ($request->file('video')) {
            $trailerPath = $this->fileService->store($request->file('video'), Course::DEFAULT_VIDEO_RESOURCE_DIRECTORY);
        }
        $information = implode(array_filter($request->information), ',');
            Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $path,
                'category_id' => $request->category_id,
                'is_visible' => false,
                'view_count' => 0,
                'scale' => 0,
                'author_id' => $request->author_id,
                'information_list' => $information,
                'trailer' => $trailerPath
            ]);
            $this->added();
        return redirect()->route('course.index');
    }

    public function edit($id)
    {
        $categories = Category::where('category_type_id', 1)
            ->doesntHave('childrens')
            ->get();
        $course = Course::findOrFail($id);
        $course->information_list = explode( ',', $course->information_list);
        return view('admin.course.edit', compact('categories', 'course'));

    }

    public function update($id, CourseStoreAndUpdateRequest $request)
    {
        $course = Course::findOrFail($id);
        $path = $course->image_path;
        $trailerPath = $course->trailer;
        if ($request->file('image')) {
            $path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'), Course::DEFAULT_RESOURCE_DIRECTORY, $path);
        }
        if ($request->file('video')) {
            $trailerPath = $this->fileService
                ->updateWithRemoveOrStore($request->file('video'),
                    Course::DEFAULT_VIDEO_RESOURCE_DIRECTORY, $trailerPath);
        }
        $information = implode(array_filter($request->information), ',');
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'information_list' => $information,
            'trailer' => $trailerPath
        ]);
        $this->edited();
        return redirect()->route('course.index');
    }

    public function visibleChange($id)
    {

        $course = Course::findOrFail($id);
        if ($course->is_visible) $course->is_visible = false;
        else $course->is_visible = true;
        $course->save();
        $this->edited();
        return redirect()->route('course.index');
    }
}
