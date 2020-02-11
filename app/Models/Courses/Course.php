<?php

namespace App\Models\Courses;

use App\Models\Categories\Category;
use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/courses';

    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'category_id', 'image_path', 'is_visible', 'view_count', 'scale', 'author_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id')->select(array('id', 'name', 'email', 'image_path'));
    }

    public function materials() {
        return $this->hasMany(CourseMaterial::class, 'course_id', 'id');
    }
}
