<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    protected $fillable = [
        'name','price','expired_at'
    ];
}
