<?php

namespace App\Http\Controllers\Api\V1\Meditation;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\v1\MeditationService;


class MeditationController extends ApiBaseController
{
    protected $meditationService;

    public function __construct(MeditationService $meditationService)
    {
        $this->meditationService = $meditationService;
    }

    public function getAllMeditations(Request $request)
    {

        $perPage = $request->size ? $request->size : 10;

        $meditations = $this->meditationService->findAll($perPage);

        return $this->successResponse(['meditations' => $meditations]);

    }

    public function getMeditation($id) {

    }
}
