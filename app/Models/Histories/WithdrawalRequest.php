<?php

namespace App\Models\Histories;

use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        "name",
        "approved_at",
        "approved_by",
        "status",
        "comment",
    ];

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
