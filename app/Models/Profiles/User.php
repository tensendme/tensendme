<?php

namespace App\Models\Profiles;

use App\Models\Categories\RecommendedCategory;
use App\Models\Courses\Course;
use App\Models\Histories\Follower;
use App\Models\Subscriptions\Subscription;
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

    public const PLATFORM_IOS = "IOS";
    public const PLATFORM_ANDROID = "ANDROID";

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
        'phone_number',
        "platform"
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

    public function lastSubscription() {
        return Subscription::where('user_id', $this->id)->where('expired_at', '>', now())
            ->orderBy('id', 'desc')->first();
    }

    public function activeSubscriptions() {
        return $this->hasMany(Subscription::class, 'user_id', 'id')
            ->where('expired_at', '>', now());
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function getBalance() {
        $balance = $this->hasOne(Balance::class, 'user_id', 'id')->first();
        if(!$balance) {
            $balance = Balance::create([
                'user_id' => $this->id,
                'balance' => 0
            ]);
        }
        return $balance;
    }

    public function balance() {
        return $this->hasOne(Balance::class, 'user_id', 'id');
    }

    public function forMe($size) {
        $recommendedCategories = $this->hasMany(RecommendedCategory::class, 'user_id', 'id')->get();
        $courses = array();
        if($recommendedCategories) {
            foreach ($recommendedCategories as $recommendedCategory) {
                $courses[] = $recommendedCategory->getCourses($size ? $size : 10);
            }
        }
        else {
            $courses = Course::paginate($size);
        }
        return $courses;
    }

    public function promoCode() {
        $promoCode = null;
        $user = true;
        while($user) {
            $promoCode = $this->generatePromoCode();
            $user = User::where('promo_code', $promoCode)->first();
        }
        return $promoCode;
    }


    public function generatePromoCode() {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < 6; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function level() {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function followers() {
        return $this->hasMany(Follower::class, 'host_user_id', 'id');
    }
}
