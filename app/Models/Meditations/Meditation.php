<?php

namespace App\Models\Meditations;

use App\Models\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meditation extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/meditations';

    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'img_path',
        'duration_time'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function themes() {
        return $this->hasMany(Theme::class, 'meditation_id', 'id');
    }

    public function audios() {
        return $this->hasMany(MeditationAudio::class, 'meditation_id', 'id')
            ->with(['author', 'language'])->select(array('id', 'audio_path', 'img_path', 'free',
                'author_id', 'duration', 'audio_language_id', 'meditation_id'));
    }
}
