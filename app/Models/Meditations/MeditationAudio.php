<?php

namespace App\Models\Meditations;

use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeditationAudio extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'audios/meditations';
    protected $table = "meditation_audios";

    protected $fillable = [
        'meditation_id',
        'audio_language_id',
        'author_id',
        'duration',
        'free',
        'img_path',
        'audio_path'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id')
            ->select(array('id', 'name', 'email', 'phone', 'image_path'));
    }

    public function meditation() {
        return $this->belongsTo(Meditation::class, 'meditation_id', 'id');
    }

    public function language() {
        return $this->belongsTo(AudioLanguage::class, 'audio_language_id', 'id')
            ->select(array('id', 'name'));
    }
}
