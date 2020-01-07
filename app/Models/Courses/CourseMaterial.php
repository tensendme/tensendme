<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $fillable = [
        'title', 'ordering', 'course_id', 'video_path'
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
