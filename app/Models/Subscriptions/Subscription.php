<?php

namespace App\Models\Subscriptions;

use App\Models\Profiles\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name','user_id','subscription_type_id','actual_price','expired_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'id');
    }

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }

    public function scopeExpiredBefore(Builder $query, $date): Builder
    {
        return $query->where('expired_at', '<=', Carbon::parse($date));
    }

    public function scopeExpiredAfter(Builder $query, $date): Builder
    {
        return $query->where('expired_at', '>=', Carbon::parse($date));
    }
}
