<?php

namespace App\Models\Courses;

use App\Models\Docs\Doc;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    public const DEFAULT_VIDEO_RESOURCE_DIRECTORY = 'videos/lessons';
    public const DEFAULT_COMPRESS_VIDEO_RESOURCE_DIRECTORY = 'videos/compressed';
    public const DEFAULT_DOCUMENT_RESOURCE_DIRECTORY = 'documents/lessons';
    public const DEFAULT_PREVIEW_RESOURCE_DIRECTORY = 'images/materials';

    protected $fillable = [
        'title', 'ordering', 'course_id', 'video_path', 'duration_time', 'img_path', 'view_count', 'free', 'description'
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function documents() {
        return $this->hasMany(Doc::class, 'course_material_id', 'id')
            ->select(array('id', 'course_material_id', 'type', 'doc_path'));
    }
}
