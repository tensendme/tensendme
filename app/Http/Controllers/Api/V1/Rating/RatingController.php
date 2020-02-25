<?php

namespace App\Http\Controllers\Api\V1\Rating;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\MeditationRatingRequest;
use App\Http\Requests\Api\V1\RatingRequest;
use App\Services\v1\RatingService;

class RatingController extends ApiBaseController
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function evaluate(RatingRequest $request) {
        return $this->successResponse(['message' => $this->ratingService->evaluate($request->course_id, $request->scale)]);
    }

    public function evaluateMeditation(MeditationRatingRequest $request) {
        return $this->successResponse(['message' => $this->ratingService->evaluateMeditation($request->meditation_id, $request->scale)]);
    }
}
