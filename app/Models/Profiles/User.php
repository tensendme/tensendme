<?php

namespace App\Models\Profiles;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * 		@SWG\Definition(
 * 			definition="User",
 * 			required={"email", "password"},
 * 			@SWG\Property(property="id", type="integer", description="UUID"),
 * 			@SWG\Property(property="email", type="string"),
 * 			@SWG\Property(property="password", type="string"),
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="nickname", type="string"),
 * 			@SWG\Property(property="device_token", type="string"),
 * 			@SWG\Property(property="promo_code", type="string"),
 * 			@SWG\Property(property="role_id", type="integer"),
 * 			@SWG\Property(property="level_id", type="integer"),
 * 			@SWG\Property(property="city_id", type="integer"),
 * 		),
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level_id',
        'city_id',
        'device_token',
        'promo_code',
        'nickname',
        'image_path',
        'role_id',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isSuperAdmin()
    {
        return $this->role_id == Role::SUPER_ADMIN_ID;
    }

    public function isAdmin()
    {
        return $this->role_id == Role::ADMIN_ID;
    }

    public function isContentManager()
    {
        return $this->role_id == Role::CONTENT_MANAGER_ID;
    }

    public function isAuthor()
    {
        return $this->role_id == Role::AUTHOR_ID;
    }

    public function isUser()
    {
        return $this->role_id == Role::USER_ID;
    }
}
