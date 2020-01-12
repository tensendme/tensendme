<?php


namespace App\Services\v1\impl;

use App\Services\v1\NewsService;
use App\Models\News\News;

class NewsServiceImpl implements NewsService
{
    public function findAll()
    {
        return News::all();
    }

    public function findAllPaginated($pageSize = 10)
    {
        return News::paginate($pageSize);
    }

    public function findAllById($id)
    {
        return News::where('id', $id)->get();
    }
}
