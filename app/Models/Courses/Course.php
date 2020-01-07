<?php

namespace App\Models\Courses;

use App\Models\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'category_id', 'image_path', 'is_visible', 'view_count', 'scale'
    ];

    public function category(){
        return $this->belongsTo( Category::class, 'category_id', 'id');
    }
}
