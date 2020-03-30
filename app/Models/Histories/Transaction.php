<?php

namespace App\Models\Histories;

use App\Models\Profiles\User;
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
}
