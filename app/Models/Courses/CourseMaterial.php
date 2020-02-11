<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    public const DEFAULT_VIDEO_RESOURCE_DIRECTORY = 'videos/lessons';
    public const DEFAULT_DOCUMENT_RESOURCE_DIRECTORY = 'documents/lessons';

    protected $fillable = [
        'title', 'ordering', 'course_id', 'video_path', 'duration_time', 'img_path'
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
