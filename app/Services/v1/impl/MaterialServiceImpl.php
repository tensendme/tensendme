<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\JobTemplates\VideoCompressJobTemplate;
use App\Models\Courses\CourseMaterial;
use App\Services\v1\MaterialService;
use Auth;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Str;

class MaterialServiceImpl implements MaterialService
{
    public function getMaterialById($id)
    {
//        $user = Auth::user();
//        $subscriptions = $user->activeSubscriptions();
        $material = CourseMaterial::where('id', $id)->with(['documents', 'course'])->first();
        if (!$material) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого материала не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
//        if(!$subscriptions->exists() && !$material->free) throw new ApiServiceException(404, false, [
//            'errors' => [
//                'Вы можете открыть доступ к этому уроку купив подписку'
//            ],
//            'errorCode' => ErrorCode::ACCESS_DENIED
//        ]);
        return $material;
    }

    public function videoCompress($id)
    {
//        $material = CourseMaterial::where('id', $id)->first();
//        if(!$material) throw new ApiServiceException(404, false, [
//            'errors' => [
//                'Такого материала не существует'
//            ],
//            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
//        ]);
//
//        $videoCompressJobTemplate = new VideoCompressJobTemplate($material->videeo_path);
//        $oldPath = $material->video_path;
//        $material->video_path = $this->compress($videoCompressJobTemplate);
//        $material->old_video_path = $oldPath;
//        $material->compressed = 1;
//        $material->save();
        //  Ну и удаление надо сделать старый путь только опасно мне кажется


    }

    public function videoCompressJob(VideoCompressJobTemplate $videoCompressJobTemplate)
    {
        $this->compress($videoCompressJobTemplate);
    }

    public function compressAll()
    {
//        $materials = CourseMaterial::where('compressed', false)->get();
//        foreach ($materials as $material) {
//            $videoCompressJobTemplate = new VideoCompressJobTemplate($material->path);
//            CompressVideo::dispatch($videoCompressJobTemplate)->onQueue(QueueConstants::VIDEO_COMPRESS_QUEUE);
//        }
    }


    public function compress(VideoCompressJobTemplate $videoCompressJobTemplate)
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => env('FF_MPEG_BINARY', '/usr/local/bin/ffmpeg'),
            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/local/bin/ffprobe')
        ]);

        // На серваке
//        $ffmpeg = FFMpeg::create([
//            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/bin/ffmpeg'),
//            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/bin/ffprobe')
//        ]);

        $fileFullOsPath = public_path($videoCompressJobTemplate->getPath());
        $video = $ffmpeg->open($fileFullOsPath);
        $fileName = ((string)Str::uuid()) . '.' . pathinfo(basename($fileFullOsPath), PATHINFO_EXTENSION);
        $publicPath = CourseMaterial::DEFAULT_VIDEO_RESOURCE_DIRECTORY . '/' . $fileName;
        $publicAbsolutePath = public_path($publicPath);

        $video
            ->filters()
            ->synchronize();
        $video
            ->save(new X264('libmp3lame'), $publicAbsolutePath);

        $material = CourseMaterial::find($videoCompressJobTemplate->getMaterialId());
        $oldPath = $material->old_video_path;
        $material->old_video_path = $material->video_path;
        $material->video_path = $publicPath;
        $material->compressed = 1;
        $material->save();

        if ($oldPath) {
            if (file_exists(public_path($oldPath))) {
                unlink(public_path($oldPath));
            }
        }
    }


}
