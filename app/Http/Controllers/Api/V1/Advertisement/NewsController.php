<?php

namespace App\Http\Controllers\Api\V1\Advertisement;

use App\Http\Controllers\ApiBaseController;
use App\Services\v1\NewsService;
use Illuminate\Http\Request;

class NewsController extends ApiBaseController
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAllNews()
    {
        $news = $this->newsService->findAll();

        return $this->successResponse(['news' => $news]);

    }


    public function getAllNewsPaginated(Request $request)
    {
        $perPage = $request->size ? $request->size : 10;


        $news = $this->newsService->findAllPaginated($perPage);

        return $this->successResponse(['news' => $news]);

    }

    public function getNewsById($id)
    {
        $news = $this->newsService->findAllById($id);

        return $this->successResponse(['news' => $news]);

    }



}
