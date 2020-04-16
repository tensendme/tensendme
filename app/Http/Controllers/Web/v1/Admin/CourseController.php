<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseControllerRequests\CourseStoreAndUpdateRequest;
use App\Models\Categories\Category;
use App\Models\Courses\Course;
use App\Models\Profiles\Role;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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
        if (!Auth::user()->isAuthor()) {
            $courses = Course::with(['author', 'lessons', 'category'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $courses = Course::with(['author', 'lessons', 'category'])
                ->where('author_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        $categories = Category::where('category_type_id', 1)->get();
        return view('admin.course.index', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('category_type_id', 1)
            ->doesntHave('childrens')
            ->get();
        $course = new Course();
        if (!empty($course)) $course = null;
        return view('admin.course.create', compact('categories', 'course'));
    }

    public function store(CourseStoreAndUpdateRequest $request)
    {
        $path = StaticConstants::DEFAULT_IMAGE;
        $trailerPath = '';
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

        if (!Auth::user()->isAuthor()) {
            $course = Course::findOrFail($id);
        } else {
            $course = Course::where('author_id', Auth::id())->findOrFail($id);
        }
        $course->information_list = explode(',', $course->information_list);
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

        if (!Auth::user()->isAuthor()) {
            $course = Course::findOrFail($id);
        } else {
            $course = Course::where('author_id', Auth::id())->findOrFail($id);
        }
        if ($course->is_visible) $course->is_visible = false;
        else $course->is_visible = true;
        $course->save();
        $this->edited();
        return redirect()->route('course.index');
    }

    public function advertiseChange($id)
    {

        $course = Course::findOrFail($id);
        if ($course->advertise) $course->advertise = false;
        else $course->advertise = true;
        $course->save();
        $this->edited();
        return redirect()->back();
    }


    public function trending()
    {
        $courses = Course::where('advertise', true)
            ->orderBy('trending_scale', 'DESC')
            ->get();
        return view('admin.course.trending', compact('courses'));
    }

    public function changePriority(Request $request)
    {
        $results = json_decode($request->getContent(), true);
        $results = collect($results);
        DB::beginTransaction();
        try {
            foreach ($results as $result) {
                Course::find($result['courseId'])->update(['trending_scale' => $result['priority']]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }

    public function filter(Request $request) {
        if (!Auth::user()->isAuthor()) {
            $courses = QueryBuilder::for(Course::class)
                ->allowedFilters(['title',
                    AllowedFilter::exact('category_id'),
                    AllowedFilter::exact('author_id'),
                    AllowedFilter::exact('is_visible'),
                    AllowedFilter::scope('created_after'),
                    AllowedFilter::scope('created_before')
                ])
                ->defaultSort('-id')
                ->allowedIncludes(['author', 'lessons', 'category'])
                ->allowedSorts('id', 'created_at', 'title', 'is_visible', 'scale', 'view_count')
                ->paginate($request->perPage);
        }
        else {
            $courses = QueryBuilder::for(Course::class)
                ->allowedFilters(['title', 'is_visible', 'advertise',
                    AllowedFilter::exact('category_id'),
                    AllowedFilter::scope('created_after'),
                    AllowedFilter::scope('created_before')
                ])
                ->where('author_id', Auth::id())
                ->defaultSort('-id')
                ->allowedIncludes(['author', 'lessons', 'category'])
                ->allowedSorts('id', 'created_at', 'title', 'is_visible', 'scale', 'view_count')
                ->paginate($request->perPage);

        }

        return view('admin.course.table', compact('courses'));
    }
}
