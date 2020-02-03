<?php

namespace App\Models\Histories;

use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        "user_comment",
        "amount",
        "approved_at",
        "approved_by",
        "status",
        "comment",
        "user_id",
    ];

    public const APPROVED = 1;
    public const CANCELLED = 2;
    public const PROCESSING = 0;

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
