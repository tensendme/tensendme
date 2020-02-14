<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AvatarRequest;
use App\Http\Requests\Api\V1\ProfileRequest;
use App\Services\v1\ProfileService;

class ProfileController extends ApiBaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function updateProfile(ProfileRequest $profile) {
        return $this->successResponse(['message' => $this->profileService->updateProfile($profile)]);
    }

    public function changeAvatar(AvatarRequest $avatar) {
        return $this->successResponse(['message' => $this->profileService->changeAvatar($avatar)]);
    }

    public function myProfile() {
        return $this->successResponse(['profile' => $this->profileService->myProfile()]);
    }
}
