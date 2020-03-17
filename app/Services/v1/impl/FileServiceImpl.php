<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 10.12.2019
 * Time: 12:18
 */

namespace App\Services\v1\impl;


use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\TimeCode;

class FileServiceImpl implements FileService
{
    public function store(UploadedFile $image, string $path): string
    {
        $image_path = time() . ((string)Str::uuid()) . 'img.' .$image->getClientOriginalExtension();
        $imageFullPath = $image->move($path, $image_path);
        return $imageFullPath;
    }

    public function lessonStore( UploadedFile $video, string $path) {
            $material = (object) array();
            $videoPath = time() . ((string)Str::uuid()) . 'video.' . $video->getClientOriginalExtension();
            $videoFullPath = $video->move($path, $videoPath);
            $material->path = $videoFullPath;

            $ffprobe = FFProbe::create([
                'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/local/bin/ffmpeg'),
                'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/local/bin/ffprobe')
            ]);;
            $duration = $ffprobe
                ->streams($videoFullPath)
                ->videos()
                ->first()
                ->get('duration');

            $material->duration = $duration;
            return $material;
        }

    public function lessonUpdate(UploadedFile $video, string $path, string $oldFilePath = null, string $oldImagePath)
    {
        if ($oldFilePath && $oldFilePath != StaticConstants::DEFAULT_VIDEO) {
            $this->remove($oldFilePath);
        }
        if ($oldImagePath && $oldImagePath != StaticConstants::DEFAULT_IMAGE) {
            $this->remove($oldImagePath);
        }

        return $this->lessonStore($video, $path);
    }


    public function remove(string $path)
    {
        if ($path != StaticConstants::DEFAULT_IMAGE) {
            if (file_exists($path) && !is_dir($path)) {
                return unlink($path);
            }
        }

        return false;
    }

    public function courseMaterialStore(UploadedFile $video, string $path) {
        $material = (object) array();
        $videoPath = time() . ((string)Str::uuid()) . 'video.' . $video->getClientOriginalExtension();
        $videoFullPath = $video->move($path, $videoPath);
        $material->path = $videoFullPath;

        $ffprobe = FFProbe::create([
            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/bin/ffmpeg'),
            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/bin/ffprobe')
        ]);;
        $duration = $ffprobe
            ->streams($videoFullPath)
            ->videos()
            ->first()
            ->get('duration');

        $sec = $duration * 35/100;
        $thumbnail = 'images/materials/' . time() . ((string)Str::uuid()) . 'preview.png';

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/bin/ffmpeg'),
            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/bin/ffprobe')
        ]);
        $video = $ffmpeg->open($videoFullPath);
        $frame = $video->frame(TimeCode::fromSeconds($sec));
        $frame->save($thumbnail);

        $material->img = $thumbnail;
        $material->duration = $duration;
        return $material;
    }

    public function courseMaterialUpdate(UploadedFile $video, string $path, string $oldFilePath = null,
                                         string $oldImagePath = null)
    {
        if ($oldFilePath && $oldFilePath != StaticConstants::DEFAULT_VIDEO) {
            $this->remove($oldFilePath);
        }
        if ($oldImagePath && $oldImagePath != StaticConstants::DEFAULT_IMAGE) {
            $this->remove($oldImagePath);
        }

        return $this->courseMaterialStore($video, $path);
    }


    public function updateWithRemoveOrStore(UploadedFile $image, string $path, string $oldFilePath = null): string
    {
        if ($oldFilePath && $oldFilePath != StaticConstants::DEFAULT_IMAGE) {
            $this->remove($oldFilePath);
        }
        return $this->store($image, $path);
    }

    public function avatarUpdateAndStore(UploadedFile $image, string $path, string $oldFilePath = null): string
    {
        if ($oldFilePath && $oldFilePath != StaticConstants::DEFAULT_AVATAR) {
            $this->remove($oldFilePath);
        }
        return $this->store($image, $path);
    }

    public function meditationAudioStore(UploadedFile $audio, string $path)
    {
        $material = (object) array();
        $audioPath = time() . ((string)Str::uuid()) . 'audio.' . $audio->getClientOriginalExtension();
        $audioFullPath = $audio->move($path, $audioPath);
        $material->path = $audioFullPath;

        $ffprobe = FFProbe::create([
            'ffmpeg.binaries'  => env('FF_MPEG_BINARY', '/usr/bin/ffmpeg'),
            'ffprobe.binaries' => env('FF_PROBE_BINARY', '/usr/bin/ffprobe')
        ]);;
        $duration = $ffprobe
            ->streams($audioFullPath)
            ->audios()
            ->first()
            ->get('duration');

        $material->duration = $duration;
        return $material;
    }

    public function meditationAudioUpdate(UploadedFile $audio, string $path, string $oldFilePath = null)
    {
        if ($oldFilePath) {
            $this->remove($oldFilePath);
        }
        return $this->meditationAudioStore($audio, $path);
    }


}
