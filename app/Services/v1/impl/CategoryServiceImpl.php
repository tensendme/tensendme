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

    public function findAll($perPage)
    {
        return Category::paginate($perPage);
    }

    public function findAllPaginated($pageSize = 10)
    {
        return Category::paginate($pageSize);
    }


}
