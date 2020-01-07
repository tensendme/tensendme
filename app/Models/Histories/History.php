<?php

namespace App\Models\Histories;

use App\Models\Courses\Course;
use App\Models\Profiles\Balance;
use App\Models\Subscriptions\Subscription;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    protected $fillable = [
        'name',
        'amount',
        'balance_id',
        'follower_id',
        'transaction_id',
        'history_type_id',
        'course_id',
        'subscription_id',
        'withdrawal_request_id'
    ];


    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balance_id', 'id');
    }

    public function follower()
    {
        return $this->belongsTo(Follower::class, 'follower_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function historyType()
    {
        return $this->belongsTo(HistoryType::class, 'history_type_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'id');
    }

    public function withdrawalRequest()
    {
        return $this->belongsTo(WithdrawalRequest::class, 'withdrawal_request_id', 'id');
    }
}
