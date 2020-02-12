<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 23:33
 */

namespace App\Services\v1\impl;


use App\Models\Categories\Category;
use App\Models\Categories\RecommendedCategory;
use App\Services\v1\CategoryService;
use Auth;

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
        return Category::with('parentCategory')->paginate($pageSize);
    }

    public function findAll()
    {
       return Category::where('parent_category_id', null)->get();
    }

    public function recommendedCategory($ids)
    {
        $user = Auth::user();
        foreach ($ids as $id) {
            $category = Category::find($id);
            if($category) {
                $recommendedCategory = RecommendedCategory::where('user_id', $user->id)->where('category_id', $category->id)->first();
                if ($category && !$recommendedCategory) {
                    RecommendedCategory::create([
                        'category_id' => $id,
                        'user_id' => $user->id
                    ]);
                }
            }
        }
        return true;
    }


}
