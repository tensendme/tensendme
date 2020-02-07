<?php

namespace App\Models\Categories;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Model;

class RecommendedCategory extends Model
{
    protected $fillable = [
        'category_id', 'user_id'
    ];

    public function categories($user_id) {
        return $this->hasMany(Category::class, 'id', 'category_id')->where('user_id', $user_id);
    }
}
