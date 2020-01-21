<?php

namespace App\Models\Education;

use App\Models\Courses\CourseMaterial;
use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;

class Passing extends Model
{
    protected $fillable = [
        'user_id', 'course_material_id'
    ];

    public function course_material(){
        return $this->belongsTo( CourseMaterial::class, 'course_material_id', 'id');
    }

    public function user(){
        return $this->belongsTo( User::class, 'user_id', 'id');
    }
}
