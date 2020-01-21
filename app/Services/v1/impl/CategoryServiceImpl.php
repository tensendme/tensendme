<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 23:33
 */

namespace App\Services\v1\impl;


use App\Models\Categories\Category;
use App\Services\v1\CategoryService;

class CategoryServiceImpl implements CategoryService
{

    public function findCoursesCategories($size = 10)
    {
        return Category::where('category_type_id', 1)->paginate($size);
    }

    public function findMeditationsCategories($size = 10)
    {
        return Category::where('category_type_id', 2)->paginate($size);
    }

    public function findAllPaginated($pageSize = 10)
    {
        return Category::paginate($pageSize);
    }


}
