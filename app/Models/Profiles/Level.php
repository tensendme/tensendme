<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/levels';

    protected $fillable = [
        'name', 'start_count', 'end_count','discount_percentage', 'logo', 'period_date', 'description'
    ];
}
