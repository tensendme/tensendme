<?php

namespace App\Models\Docs;

use App\Models\Courses\CourseMaterial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doc extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type', 'course_material_id', 'doc_path'
    ];

    public function course_material(){
        return $this->belongsTo( CourseMaterial::class, 'course_material_id', 'id');
    }
}
