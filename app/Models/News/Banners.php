<?php

namespace App\Models\Banners;


use App\Models\News\Locations;
use App\Models\News\News;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
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
        return $this->belongsTo(Locations::class, 'location_id', 'id');
    }

}
