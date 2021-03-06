<?php

namespace App\Models\Courses;

use App\Models\Categories\Category;
use App\Models\Profiles\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/courses';
    public const DEFAULT_VIDEO_RESOURCE_DIRECTORY = 'videos/trailers';

    use SoftDeletes;

    protected $fillable = [
        'title', 'description',
        'category_id', 'image_path',
        'is_visible', 'view_count',
        'scale', 'trending_scale',
        'author_id', 'information_list', 'trailer'
    ];

    protected $hidden = [
        'advertise'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id')->select(array('id',
            'name', 'email', 'image_path', 'surname', 'father_name'));
    }

    public function lessons()
    {
        return $this->hasMany(CourseMaterial::class, 'course_id', 'id')
            ->orderBy('ordering', 'asc')
            ->select(array('id', 'title', 'img_path', 'duration_time', 'course_id', 'free'));
    }

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }
}
