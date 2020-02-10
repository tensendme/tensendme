<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseMaterialControllerRequest\CourseMaterialStoreAndUpdateRequest;
use App\Models\Courses\Course;
use App\Models\Courses\CourseMaterial;
use App\Models\Docs\Doc;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use File;

class CourseMaterialController extends WebBaseController
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

    public function index($course_id){
        $materials = CourseMaterial::where('course_id', $course_id)->get();
        return view('admin.course.materials.index', compact('materials', 'course_id'));
    }

    public function create($course_id) {
        $material = new CourseMaterial();
        return view('admin.course.materials.create', compact('material', 'course_id'));
    }

    public function store(CourseMaterialStoreAndUpdateRequest $request, $course_id) {
        $path = StaticConstants::DEFAULT_VIDEO;
        if ($request->file('video')) {
            $path = $this->fileService->store($request->file('video'), CourseMaterial::DEFAULT_VIDEO_RESOURCE_DIRECTORY);
        }
        $material = CourseMaterial::create([
            'title' => $request->title,
            'video_path' => $path,
            'course_id' => $course_id,
            'ordering' => $request->ordering

        ]);
        if($request->has('docs')) {
            if($request->docs) {
                foreach ($request->docs as $document) {
                    $path = $this->fileService->store($document, CourseMaterial::DEFAULT_DOCUMENT_RESOURCE_DIRECTORY);
                    Doc::create([
                        'course_material_id' => $material->id,
                        'type' => $document->getClientOriginalExtension(),
                        'doc_path' => $path
                    ]);
                }
            }
        }
        $this->added();
        return redirect()->route('course.material.index', compact('course_id'));
    }

    public function edit($id) {
        $courses = Course::all();
        $material = CourseMaterial::findOrFail($id);
        return view('admin.course.materials.edit', compact('material', 'courses'));
    }

    public function update($id, CourseMaterialStoreAndUpdateRequest $request) {
        $material = CourseMaterial::findOrFail($id);
        $path = $material->video_path;
        if($request->file('video')) {
            $path = $this->fileService->updateWithRemoveOrStore($request->file('video'),
                CourseMaterial::DEFAULT_VIDEO_RESOURCE_DIRECTORY, $path);
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
