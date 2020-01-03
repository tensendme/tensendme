<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Services\v1\CategoryService;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $categories = $this->categoryService->findAll();
        return view('admin/category/index', compact('categories'));
    }
}
