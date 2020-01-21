<?php

namespace App\Http\Controllers\Api\V1\Category;


use App\Services\v1\CategoryService;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;


class CategoryController extends ApiBaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllCategories(Request $request)
    {


        $perPage = $request->size ? $request->size : 10;

        $categories = $this->categoryService->findAll($perPage);

        return $this->successResponse(['categories' => $categories]);

    }



}
