<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseMaterialControllerRequest\StoreAndUpdateRequest;
use App\Models\Courses\Course;
use App\Models\Courses\CourseMaterial;
use File;

class CourseMaterialController extends WebBaseController
{
    public function index($course_id){
        $materials = CourseMaterial::where('course_id', $course_id)->get();
        return view('admin.course.materials.index', compact('materials', 'course_id'));
    }

    public function create($course_id) {
        $material = new CourseMaterial();
        return view('admin.course.materials.create', compact('material', 'course_id'));
    }

    public function store(StoreAndUpdateRequest $request, $course_id) {
        $path = '';
        if($request->file('video')) {
            $filename = $request->title.time().'.'.$request->file('video')->getClientOriginalExtension();
            $request->video->move(public_path('videos/courses'), $filename);
            $path = '/courses/'.$filename;
        }
        CourseMaterial::create([
            'title' => $request->title,
            'video_path' => $path,
            'course_id' => $course_id,
            'ordering' => $request->ordering

        ]);
        $this->added();
        return redirect()->route('course.material.index', compact('course_id'));
    }

    public function edit($id) {
        $courses = Course::all();
        $material = CourseMaterial::findOrFail($id);
        return view('admin.course.materials.edit', compact('material', 'courses'));
    }

    public function update($id, StoreAndUpdateRequest $request) {
        $material = CourseMaterial::findOrFail($id);
        $path = $material->video_path;
        if($request->file('video')) {
            $filename = $request->title.time().'.'.$request->file('video')->getClientOriginalExtension();
            $request->video->move(public_path('videos/courses'), $filename);
            $path = '/courses/'.$filename;
            if($material->video_path) File::delete('videos/'.$material->video_path);
        }
        $material->update([
            'title' => $request->title,
            'video_path' => $path,
            'ordering' => $request->ordering
        ]);
        $course_id = $material->course->id;
        $this->edited();
        return redirect()->route('course.material.index', compact('course_id'));
    }

    public function delete($id) {
        $material = CourseMaterial::findOrFail($id);
        $course_id = $material->course->id;
        $material->delete();
        $this->deleted();
        return redirect()->route('course.material.index', compact('course_id'));


    }
}
