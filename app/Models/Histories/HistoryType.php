<?php

namespace App\Models\Histories;

use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
    public const SUBSCRIPTION = 1;
    public const FOLLOWER = 2;
    public const WITHDRAWAL = 3;
    public const PAYMENT = 4;
    protected $fillable = [
        'name'
    ];
}
