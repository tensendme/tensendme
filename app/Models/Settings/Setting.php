<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'about_us', 'title', 'address', 'phone', 'copyright', 'img_path'
    ];
}
