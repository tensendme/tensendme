<?php

namespace App\Models\Banners;


use App\Models\News\Location;
use App\Models\News\News;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/banner';


    protected $fillable = [
        'title',
        'news_id',
        'location_id',
        'image_path'
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

}
