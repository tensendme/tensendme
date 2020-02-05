<?php

namespace App\Models\Histories;

use App\Models\Profiles\Level;
use App\Models\Profiles\User;
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

}
