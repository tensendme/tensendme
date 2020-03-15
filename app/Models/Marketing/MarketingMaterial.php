<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class MarketingMaterial extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/marketing-materials';

    protected $fillable = [
        'url',
        'name',
        'image_path'
    ];
}
