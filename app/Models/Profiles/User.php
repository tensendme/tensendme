<?php

namespace App\Models\Profiles;

use App\Models\Categories\RecommendedCategory;
use App\Models\Courses\Course;
use App\Models\Education\Passing;
use App\Models\Education\UserCourse;
use App\Models\Histories\Follower;
use App\Models\Subscriptions\Subscription;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public const PLATFORM_IOS = "IOS";
    public const PLATFORM_ANDROID = "ANDROID";
    public const DEFAULT_RESOURCE_DIRECTORY = 'images/avatars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'father_name',
        'email',
        'password',
        'level_id',
        'city_id',
        'phone',
        'device_token',
        'promo_code',
        'nickname',
        'image_path',
        'role_id',
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

    public function isAccountant()
    {
        return $this->role_id == Role::ACCOUNTANT_ID;
    }

    public function isAuthor()
    {
        return $this->role_id == Role::AUTHOR_ID;
    }

    public function isUser()
    {
        return $this->role_id == Role::USER_ID;
    }

    public function lastSubscription()
    {
        return Subscription::where('user_id', $this->id)->where('expired_at', '>', now())
            ->orderBy('id', 'desc')->first();
    }

    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id')
            ->where('expired_at', '>', now());
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function getBalance()
    {
        $balance = $this->hasOne(Balance::class, 'user_id', 'id')->first();
        if (!$balance) {
            $balance = Balance::create([
                'user_id' => $this->id,
                'balance' => 0
            ]);
        }
        return $balance;
    }

    public function balance()
    {
        return $this->hasOne(Balance::class, 'user_id', 'id');
    }

    public function forMe($size)
    {
        $recommendedCategories = RecommendedCategory::where('user_id', $this->id)->get();
        if ($recommendedCategories) {
            $categoryIds = $recommendedCategories->pluck('category_id')->toArray();
            $courses = Course::whereIn('category_id', $categoryIds)->where('is_visible', 1)
                ->orderBy('scale', 'desc')
                ->with('author')
                ->with('lessons')
                ->paginate($size ? $size : 10);
//            $courses = Course::where('is_visible', 1)->paginate($size ? $size : 10);

        } else {
            $courses = Course::where('is_visible', 1)
                ->orderBy('scale', 'desc')
                ->with('author')
                ->with('lessons')
                ->paginate($size ? $size : 10);
        }
        $coursesItems = $courses->getCollection();
        $startedCourse = UserCourse::whereIn('course_id', $coursesItems->pluck('id'))->where('user_id', $this->id)->get();
        foreach ($coursesItems as $course) {
            $courseMaterials = $course->lessons;
            $course->lessons_count = $courseMaterials->count();
            $count = Passing::whereIn('course_material_id', $courseMaterials->pluck('id'))
                ->where('user_id', $this->id)->count();
            $course->information_list = array_filter(explode(',', $course->information_list));
            $course->lessons_passing_count = $count;
            $started = $startedCourse->where('course_id', $course->id)->first();
            $course->started = $started ? true : false;
            $course->makeHidden('lessons');
        }

        $courses->setCollection($coursesItems);
        return $courses;
    }

    public function promoCode()
    {
        $promoCode = null;
        $user = true;
        while ($user) {
            $promoCode = $this->generatePromoCode();
            $user = User::where('promo_code', $promoCode)->first();
        }
        return $promoCode;
    }


    public function generatePromoCode()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for ($i = 0; $i < 6; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        if($this->nickname)
            return 'TS-'. $this->nickname . '-' .$random_string;
        else return 'TS-'.$random_string;
    }

    public function level()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'host_user_id', 'id');
    }


    public function analyze($dateStart = null, $dateFinish = null)
    {
        if (!$this->id) {
            return [];
        }
        $query = DB::table('promo_code_analytics')
            ->select('type', DB::raw('count(id) as count'))
            ->groupBy('type')
            ->where('host_user_id', $this->id);

        if ($dateStart) {
            $query->where('created_at', '>=', $dateStart);
        }

        if ($dateFinish) {
            $query->where('created_at', '<=', $dateFinish);
        }

        $result = $query->get();
        return $result;
    }

    public function certificates() {
        return $this->hasMany(Certificate::class, 'user_id', 'id')
            ->with(['course.author', 'course.lessons']);

    }
}
