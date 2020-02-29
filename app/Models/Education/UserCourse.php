<?php

namespace App\Models\Education;

use App\Models\Courses\Course;
use App\Models\Courses\CourseMaterial;
use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $fillable = [
        'user_id', 'course_id'
    ];

    public function course(){
        return $this->belongsTo( Course::class, 'course_id', 'id');
    }

    public function user(){
        return $this->belongsTo( User::class, 'user_id', 'id');
    }
}
