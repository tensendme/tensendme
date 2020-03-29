<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'url', 'img_path', 'title', 'is_visible'
    ];
}
