<?php

namespace App\Models\PushNotifications;

use Illuminate\Database\Eloquent\Model;

class PushType extends Model
{
    public const GENERAL_PUSH_INDB_ID = 1;
    protected $fillable = ['name'];
}
