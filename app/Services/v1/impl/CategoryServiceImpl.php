<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 23:33
 */

namespace App\Services\v1\impl;


use App\Category;
use App\Services\v1\CategoryService;

class CategoryServiceImpl implements CategoryService
{

    public function findAll()
    {
        return Category::all();
    }
}