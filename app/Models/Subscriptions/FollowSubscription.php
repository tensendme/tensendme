<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Model;

class FollowSubscription extends Model
{
    protected $fillable = [
        'host_user_id',
        'subscription_id',
        'level_id',
        'follower_user_id'
    ];
}
