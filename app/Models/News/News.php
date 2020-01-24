<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/news';
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image_path',
        'description',
        'banner_position',
    ];
}
