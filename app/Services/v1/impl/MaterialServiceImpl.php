<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Courses\CourseMaterial;
use App\Services\v1\MaterialService;
use Auth;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Str;

class MaterialServiceImpl implements MaterialService
{
    public function getMaterialById($id)
    {
//        $user = Auth::user();
//        $subscriptions = $user->activeSubscriptions();
        $material = CourseMaterial::where('id', $id)->with(['documents', 'course'])->first();
        if(!$material) throw new ApiServiceException(404, false, [
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
        $material = CourseMaterial::where('id', $id)->first();
        if(!$material) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого материала не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/local/bin/ffmpeg'),
            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/local/bin/ffprobe')
        ]);

            // На серваке
//        $ffmpeg = FFMpeg::create([
//            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/bin/ffmpeg'),
//            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/bin/ffprobe')
//        ]);

        $fileName = time() . ((string)Str::uuid()) . 'compressed.mp4';
        $path = CourseMaterial::DEFAULT_VIDEO_RESOURCE_DIRECTORY. '/' .$fileName;
        $video = $ffmpeg->open($material->video_path);
        $video
            ->filters()
            ->synchronize();
        $video
            //   Надо путь создать либо в той же папке где лессонс а то он автоматом не создает и доступы дать
            ->save(new X264('libmp3lame'), $path);

        $material->video_path = $path;
        $material->save();
        //  Ну и удаление надо сделать старый путь только опасно мне кажется


    }


}
