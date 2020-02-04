<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    public const SUBSCRIPTION_BALANCE = 500;

    protected $fillable = [
        'user_id',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
