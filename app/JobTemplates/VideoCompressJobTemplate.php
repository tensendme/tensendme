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

    /**
     * VideoCompressJobTemplate constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }


}
