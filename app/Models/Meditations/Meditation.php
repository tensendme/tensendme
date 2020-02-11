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
}
