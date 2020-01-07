<?php

namespace App\Models\Histories;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    protected $fillable = [
        'name','amount','balance_id','follower_id','transaction_id','history_type_id','course_id','subscription_id','withdrawal_request_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'id');
    }
}
