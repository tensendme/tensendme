<?php

namespace App\Models\Meditations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'meditation_id'
    ];

    public function audios(){
        return $this->hasMany(ThemeAudio::class, 'theme_id', 'id');
    }

    public function meditation(){
        return $this->belongsTo(Meditation::class, 'meditation_id', 'id');
    }
}
