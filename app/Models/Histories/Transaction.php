<?php

namespace App\Models\Histories;

use App\Models\Profiles\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const APPROVED = 1;
    public const CANCELLED = 2;
    public const PROCESSING = 0;
    public const CARD_SAVE_SUCCESS = 3;
    public const CARD_SAVE_FAILURE = 4;

    protected $fillable = [
        'order_id', // EXTERNAL SYSTEM ORDER
        'sum',
        'status',
        'user_id',
        'external_status',
        'card_holder_message',
        'currency'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }
}
