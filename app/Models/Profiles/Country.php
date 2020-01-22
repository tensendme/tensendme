<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone_prefix'
    ];
}
