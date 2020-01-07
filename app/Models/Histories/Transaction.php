<?php

namespace App\Models\Histories;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id', // EXTERNAL SYSTEM ORDER
        'sum',
        'status'
    ];
}
