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

class FileServiceImpl implements FileService
{
    public function store(UploadedFile $image, string $path): string
    {
        $image_path = time() . ((string)Str::uuid()) . $image->getClientOriginalName();
        $imageFullPath = $image->move($path, $image_path);
        return $imageFullPath;
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

    public function updateWithRemoveOrStore(UploadedFile $image, string $path, string $oldFilePath = null): string
    {
        if ($oldFilePath && $oldFilePath != StaticConstants::DEFAULT_IMAGE) {
            $this->remove($oldFilePath);
        }
        return $this->store($image, $path);
    }


}