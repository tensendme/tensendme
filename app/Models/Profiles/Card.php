<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        "user_id", "last_four", "token", "type"
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
