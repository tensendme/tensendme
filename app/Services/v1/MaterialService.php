<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 21.01.2020
 * Time: 22:20
 */

namespace App\Services\v1;


use App\JobTemplates\VideoCompressJobTemplate;

interface MaterialService
{
    public function getMaterialById($id);
    public function videoCompress($id);
    public function videoCompressJob(VideoCompressJobTemplate $videoCompressJobTemplate);
    public function compressAll();
}
