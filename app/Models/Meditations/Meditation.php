<?php

namespace App\Models\Meditations;

use App\Models\Categories\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        'is_visible',
        'scale'
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

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }
}
