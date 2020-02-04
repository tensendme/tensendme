<?php

namespace App\Http\Controllers\Api\V1\Follower;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FollowerRequest;
use App\Services\v1\FollowerService;
use Illuminate\Http\Request;

class FollowerController extends ApiBaseController
{
    protected $followerService;

    public function __construct(FollowerService $followerService)
    {
        $this->followerService = $followerService;
    }

    public function follow(FollowerRequest $request) {
        return $this->successResponse(['message' => $this->followerService->follow($request->promoCode)]);
    }
}
