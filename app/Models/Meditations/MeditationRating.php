<?php

namespace App\Models\Meditations;

use Illuminate\Database\Eloquent\Model;

class MeditationRating extends Model
{
    protected $table = "meditation_ratings";

    protected $fillable = [
        'scale', 'user_id', 'meditation_id'
    ];
}
