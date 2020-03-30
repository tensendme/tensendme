<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.02.2020
 * Time: 19:53
 */

namespace App\JobTemplates;


class VideoCompressJobTemplate
{
    private $path;
    private $materialId;

    /**
     * VideoCompressJobTemplate constructor.
     * @param $path
     */
    public function __construct($path, $materialId)
    {
        $this->path = $path;
        $this->materialId = $materialId;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getMaterialId()
    {
        return $this->materialId;
    }


}
