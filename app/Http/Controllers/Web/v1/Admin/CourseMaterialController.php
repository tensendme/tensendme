<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseMaterialControllerRequest\StoreAndUpdateRequest;
use App\Models\Courses\Course;
use App\Models\Courses\CourseMaterial;
use File;

class CourseMaterialController extends WebBaseController
{
    public function index(){
        $materials = CourseMaterial::paginate(10);
        return view('admin.course.materials.index', compact('materials'));
    }

    public function create() {
        $courses = Course::all();
        $material = new CourseMaterial();
        return view('admin.course.materials.create', compact('material', 'courses'));
    }

    public function store(StoreAndUpdateRequest $request) {
        $path = '';
        if($request->file('video')) {
            $filename = $request->title.time().'.'.$request->file('video')->getClientOriginalExtension();
            $request->video->move(public_path('videos/courses'), $filename);
            $path = '/courses/'.$filename;
        }
        CourseMaterial::create([
            'title' => $request->title,
            'video_path' => $path,
            'course_id' => $request->course_id,
            'ordering' => $request->ordering

        ]);
        $this->added();
        return redirect()->route('course.material.index');
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
            'course_id' => $request->course_id,
            'ordering' => $request->ordering
        ]);
        $this->edited();
        return redirect()->route('course.material.index');
    }

    public function delete($id) {
        CourseMaterial::destroy($id);
        $this->deleted();
        return redirect()->route('course.material.index');


    }
}
