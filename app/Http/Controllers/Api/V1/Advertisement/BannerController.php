<?php

namespace App\Http\Controllers\Api\V1\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiBaseController;
use App\Services\v1\BannerService;

use Illuminate\Http\Request;

class BannerController extends ApiBaseController
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function getAllBanners()
    {
        $banners = $this->bannerService->findAll();

        return $this->successResponse(['banners' => $banners]);

    }


    public function getAllBannersPaginated(Request $request)
    {
        $perPage = $request->size ? $request->size : 10;

        $banners = $this->bannerService->findAllPaginated($perPage);

        return $this->successResponse(['banners' => $banners]);

    }

    public function getBannerById($id)
    {
        $banner = $this->bannerService->findAllById($id);

        return $this->successResponse(['banner' => $banner]);

    }

    public function getBannerByLocation($location_id)
    {
        $banner = $this->bannerService->findAllByLocation($location_id);

        return $this->successResponse(['banner' => $banner]);

    }

}
