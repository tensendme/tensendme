<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 10.12.2019
 * Time: 12:17
 */

namespace App\Services\v1;


use Illuminate\Http\UploadedFile;

interface FileService
{

    public function store(UploadedFile $image, string $path): string;

    public function remove(string $path);

    public function updateWithRemoveOrStore(UploadedFile $image, string $path, string $oldFilePath = null): string;

}