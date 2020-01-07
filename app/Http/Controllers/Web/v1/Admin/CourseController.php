<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseControllerRequests\StoreAndUpdateRequest;
use App\Models\Categories\Category;
use App\Models\Courses\Course;
use File;

class CourseController extends WebBaseController
{
    public function index() {
        $courses = Course::paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    public function create() {
        $categories = Category::all();
        $course = new Course();
        return view('admin.course.create', compact('categories', 'course'));
    }

    public function store(StoreAndUpdateRequest $request) {
        $path = '/courses/default.png';
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/courses'), $filename);
            $path = '/courses/'.$filename;
        }
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            'category_id' => $request->category_id,
            'is_visible' => false,
            'view_count' => 0,
            'scale' => 0
        ]);
        $this->added();
        return redirect()->route('course.index');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $course = Course::findOrFail($id);
        return view('admin.course.edit', compact('categories', 'course'));

    }

    public function update($id, StoreAndUpdateRequest $request) {
        $course = Course::findOrFail($id);
        $path = $course->image_path;
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/courses'), $filename);
            $path = '/courses/'.$filename;
            if($course->image_path != '/courses/default.png') File::delete('images/'.$course->image_path);
        }
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            'category_id' => $request->category_id,
        ]);
        $this->edited();
        return redirect()->route('course.index');
    }

    public function visibleChange($id) {

        $course = Course::findOrFail($id);
        if($course->is_visible) $course->is_visible = false;
        else $course->is_visible = true;
        $course->save();
        $this->edited();
        return redirect()->route('course.index');
    }
}
