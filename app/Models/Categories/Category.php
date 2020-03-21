<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/categories';

    protected $fillable = [
        'name', 'category_type_id', 'parent_category_id', 'img_path', 'is_visible'
    ];

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }
}
