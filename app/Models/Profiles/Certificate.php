<?php

namespace App\Models\Profiles;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name','surname', 'course_id', 'user_id', 'father_name', 'course_name'
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
