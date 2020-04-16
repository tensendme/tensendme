<?php

namespace App\Models\Histories;

use App\Models\Profiles\Level;
use App\Models\Profiles\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'follower_user_id',
        'host_user_id',
        'level_id'
    ];


    public function followerUser()
    {
        return $this->belongsTo(User::class, 'follower_user_id', 'id');
    }

    public function hostUser()
    {
        return $this->belongsTo(User::class, 'host_user_id', 'id');
    }

    public function level() {
        return $this->belongsTo(Level::class, 'level_id', 'id');
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
