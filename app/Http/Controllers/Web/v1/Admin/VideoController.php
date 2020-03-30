<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Jobs\CompressVideo;
use App\JobTemplates\VideoCompressJobTemplate;
use App\Models\Courses\CourseMaterial;
use App\Queues\QueueConstants;
use App\Services\v1\FileService;
use App\Services\v1\MaterialService;
use Illuminate\Http\Request;

class VideoController extends WebBaseController
{
    protected $fileService;
    protected $materialService;

    /**
     * CourseController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService, MaterialService $materialService)
    {
        $this->fileService = $fileService;
        $this->materialService = $materialService;
    }

    public function compress($id)
    {
        $material = CourseMaterial::findOrFail($id);
        if ($material->compressed)
            throw new WebServiceErroredException('Видео уже сжат!');

        $videoCompressJobTemplate = new VideoCompressJobTemplate($material->video_path, $material->id);
        CompressVideo::dispatch($videoCompressJobTemplate)->onQueue(QueueConstants::VIDEO_COMPRESS_QUEUE);
        $this->edited();
        return redirect()->route('course.material.index', ['course_id' => $material->course_id]);

    }
}
