<?php

namespace App\Http\Controllers\Api\V1\Course;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Services\v1\MaterialService;
use Illuminate\Http\Request;

class MaterialController extends ApiBaseController
{
    protected $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    public function getMaterialById($id) {
        return $this->successResponse(['material' => $this->materialService->getMaterialById($id)]);
    }

    public function videoCompress($id) {
        return $this->successResponse(['path' => $this->materialService->videoCompress($id)]);
    }
}
