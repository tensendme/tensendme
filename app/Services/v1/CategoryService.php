<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 23:32
 */

namespace App\Services\v1;


interface CategoryService
{
    public function findCoursesCategories($size);
    public function findMeditationsCategories($size);

    public function findAllPaginated($pageSize = 10);
    public function findAll();
    public function recommendedCategory($ids);
}
