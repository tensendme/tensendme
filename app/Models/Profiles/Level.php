<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name', 'start_count', 'end_count','discount_percentage', 'logo', 'period_date'
    ];
}
