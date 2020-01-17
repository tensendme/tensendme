<?php

namespace App\Models\FAQs;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question',
        'image_path',
        'answer',
    ];

}
