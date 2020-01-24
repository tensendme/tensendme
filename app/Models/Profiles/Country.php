<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/countries';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone_prefix',
        'image_path',
    ];
}
