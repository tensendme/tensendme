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
        if ($request->has('size')){

            $pageSize = (int)$request->size;
        }



        $news = $this->newsService->findAllPaginated($pageSize=1);

        return $this->successResponse(['news' => $news]);

    }

    public function getNewsById($id)
    {
        $news = $this->newsService->findAllById($id);

        return $this->successResponse(['news' => $news]);

    }



}
