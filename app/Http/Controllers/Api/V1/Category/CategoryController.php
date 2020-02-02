<?php

namespace App\Http\Controllers\Api\V1\Category;


use App\Http\Requests\Api\V1\CategoryRequest;
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

    public function getCoursesCategories(Request $request)
    {

        $perPage = $request->size ? $request->size : 10;

        $categories = $this->categoryService->findCoursesCategories($perPage);

        return $this->successResponse(['categories' => $categories]);

    }

    public function getMeditationsCategories(Request $request)
    {
        $size = $request->size ? $request->size : 10;
        $categories = $this->categoryService->findMeditationsCategories($size);
        return $this->successResponse(['categories' => $categories]);
    }

    public function getCategories() {
        $categories = $this->categoryService->findAll();
        return $this->successResponse(['categories' => $categories]);
    }

    public function recommendedCategories(CategoryRequest $request) {
        return $this->successResponse(['success' => $this->categoryService->recommendedCategory($request->categoriesIds)]);
    }



}
