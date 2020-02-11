<?php

namespace App\Models\Meditations;

use Illuminate\Database\Eloquent\Model;

class ThemeAudio extends Model
{

    public const DEFAULT_RESOURCE_DIRECTORY = 'audios/meditations';

    protected $table = "theme_audios";
    protected $fillable = [
        'theme_id',
        'audio_path',
        'audio_language_id'
    ];

}
