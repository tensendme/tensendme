<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const SUPER_ADMIN_ID = 1;
    public const ADMIN_ID = 2;
    public const CONTENT_MANAGER_ID = 3;
    public const AUTHOR_ID = 4;
    public const USER_ID = 5;

    protected $fillable = [
        'name'
    ];
}
