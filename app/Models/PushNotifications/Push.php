<?php

namespace App\Models\PushNotifications;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $fillable = ['content', 'push_type_id'];
}
