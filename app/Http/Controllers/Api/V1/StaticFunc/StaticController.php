<?php

namespace App\Http\Controllers\Api\V1\StaticFunc;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Models\Profiles\Country;
use App\Services\v1\StaticService;
use Illuminate\Http\Request;

class StaticController extends ApiBaseController
{

    protected $staticService;

    /**
     * StaticController constructor.
     * @param $staticService
     */
    public function __construct(StaticService $staticService)
    {
        $this->staticService = $staticService;
    }


    public function getAllCountries()
    {
        return $this->successResponse(['countries' => $this->staticService->getAllCountries()]);
    }

    public function getAllLevels()
    {
        return $this->successResponse(['levels' => $this->staticService->getLevels()]);
    }

    public function getAllFaqs()
    {
        return $this->successResponse(['faqs' => $this->staticService->getAllFaqs()]);
    }

    public function getAboutTensend()
    {
        $url="https://tensend.me/#features-section";
        return $this->successResponse(['url' => $url]);
    }

    public function aboutTensend() {
        return $this->successResponse(['tensend' => $this->staticService->aboutTensend()]);
    }
}
