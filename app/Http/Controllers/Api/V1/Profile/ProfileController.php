<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\AvatarRequest;
use App\Http\Requests\Api\V1\ProfileRequest;
use App\Services\v1\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends ApiBaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function updateProfile(ProfileRequest $profile)
    {
        return $this->successResponse(['message' => $this->profileService->updateProfile($profile)]);
    }

    public function changeAvatar(AvatarRequest $avatar)
    {
        return $this->successResponse(['message' => $this->profileService->changeAvatar($avatar)]);
    }

    public function myProfile()
    {
        return $this->successResponse(['profile' => $this->profileService->myProfile()]);
    }

    public function getMyReferralLink()
    {
        return $this->successResponse(['link' => $this->profileService->myReferralLink(Auth::user())]);
    }

    public function myCertificates()
    {
        return $this->successResponse(['certificates' => $this->profileService->myCertificates()]);
    }

    public function myMarketingMaterials()
    {
        return $this->successResponse(['materials' => $this->profileService->myMarketingMaterials()]);
    }
}
