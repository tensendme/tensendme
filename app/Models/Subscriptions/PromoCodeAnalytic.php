<?php

namespace App\Models\Subscriptions;


use App\Models\Profiles\User;
use Illuminate\Database\Eloquent\Model;

class PromoCodeAnalytic extends Model
{
    public const TYPE_PASSED = 1;
    public const TYPE_INSTALLED = 2;
    public const TYPE_PURCHASED = 3;
    public const TYPE_CAME = 4;

    protected $fillable = [
        'host_user_id',
        'promo_code',
        'ip_address',
        'phone',
        'type',
        'follower_user_id'
    ];

    public function hostUser()
    {
        return $this->belongsTo(User::class, 'host_user_id');
    }

    public function followerUser()
    {
        return $this->belongsTo(User::class, 'follower_user_id');
    }
}
