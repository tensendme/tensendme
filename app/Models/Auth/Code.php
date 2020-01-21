<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'login',
        'code',
    ];
}
