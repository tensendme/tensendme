<?php

namespace App\Http\Controllers\Api\V1\Category;


use App\Services\v1\CategoryService;
use App\Http\Controllers\ApiBaseController;


class CategoryController extends ApiBaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryService->findAll();

        return $this->successResponse(['categories' => $categories]);

    }



}
