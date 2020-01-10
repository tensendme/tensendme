<?php

namespace App\Models\Meditations;

use Illuminate\Database\Eloquent\Model;

class ThemeAudio extends Model
{
    protected $table = "theme_audios";
    protected $fillable = [
        'theme_id',
        'audio_path',
        'audio_language_id'
    ];

}
