<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;

use App\Models\Education\Passing;
use App\Models\Marketing\MarketingMaterial;
use App\Models\Profiles\City;
use App\Models\Profiles\Level;
use App\Models\Profiles\User;
use App\Services\v1\FileService;
use App\Services\v1\ProfileService;
use App\Services\v1\PromoCodeAnalyticService;
use App\Services\v1\RatingService;
use Auth;

class ProfileServiceImpl implements ProfileService
{
    protected $fileService;
    protected $ratingService;

    /**
     * ProfileServiceImpl constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService,
                                RatingService $ratingService)
    {
        $this->fileService = $fileService;
        $this->ratingService = $ratingService;
    }


    public function updateProfile($profile)
    {
        $user = Auth::user();
//        if ($profile->nickname != $user->nickname) {
//            $user->nickname = $profile->nickname;
//            $user->promo_code = $user->promoCode();
//        }
        $city = City::find($profile->cityId);
        if ($city) {
            $user->city_id = $profile->cityId;
        }
        if ($profile->name) {
            $user->name = $profile->name;
        }
        if ($profile->surname) {
            $user->surname = $profile->surname;
        }
        if ($profile->fatherName) {
            $user->father_name = $profile->fatherName;
        }
        $user->save();
        return "Изменения успешно сохранены!";
    }

    public function changeAvatar($avatar)
    {
        $user = Auth::user();
        $path = User::DEFAULT_RESOURCE_DIRECTORY;
        $oldPath = $user->image_path;
        $path = $this->fileService->avatarUpdateAndStore($avatar->avatar, $path, $oldPath);
        $user->image_path = $path;
        $user->save();
        return "Аватар успешно изменен!";
    }

    public function myProfile()
    {
        $user = Auth::user();
        $profile = (object)array();
        $profile->id = $user->id;
        $profile->avatar = $user->image_path;
        $profile->name = $user->name;
        $profile->surname = $user->surname;
        $profile->phone = $user->phone;
        $profile->fatherName = $user->father_name;
        $profile->promoCode = $user->promo_code;
        $profile->created = $user->created_at;
        $profile->levelId = $user->level ? $user->level->id : '';
        $profile->level = $user->level ? $user->level->name : '';
        $profile->levelImage = $user->level ? $user->level->logo : '';
        $profile->discountPercentage = $user->level->discount_percentage;
        $profile->balance = $user->getBalance()->balance;
        $profile->city = $user->city ? $user->city->name : 'Алматы';
        $profile->role = $user->role->name == 'Author' ? 'Автор' : 'Пользователь';
//        $profile->followers_count = $user->followers->count();
        $profile->nickname = 'share/' . $user->promo_code;
        $profile->permission = false;
//        $this->myReferralLink($this);
        $ratingAnalytic = $this->ratingService->specificUserRating($user->id);

        $profile->passed = Passing::where('user_id', Auth::id())->count();

        if ($ratingAnalytic) {
            $profile->activity = 0;
            $profile->tensend = $ratingAnalytic->purchased;
            $profile->rating = $ratingAnalytic->purchased;

            $profile->clicks_count = $ratingAnalytic->came;
            $profile->click_count = $ratingAnalytic->came;
            $profile->registrations_count = $ratingAnalytic->installed;
            $profile->subscriptions_count = $ratingAnalytic->purchased;
            $profile->requests_count = $ratingAnalytic->passed;
        } else {

            $profile->activity = 0;
            $profile->tensend = 0;
            $profile->rating = 0;

            $profile->clicks_count = 0;
            $profile->click_count = 0;
            $profile->registrations_count = 0;
            $profile->subscriptions_count = 0;
            $profile->requests_count = 0;
        }
//        foreach ($analyzes as $analyze) {
//            switch ($analyze->type) {
//                case 1:
//                    $profile->click_count = $analyze->count;
//                    break;
//                case 2:
//                    $profile->registrations_count = $analyze->count;
//                    break;
//                case 3:
//                    $profile->subscriptions_count = $analyze->count;
//                    break;
//                case 4:
//                    $profile->requests_count = $analyze->count;
//                    break;
//            }
//        }

        $profile->subscriptions = array();
        foreach ($user->activeSubscriptions as $subscription) {
            $profile->subscriptions[] = array(
                'subscriptionType' => $subscription->subscriptionType->name,
                'price' => $subscription->actual_price,
                'expiredAt' => $subscription->expired_at
            );
        }
        if (!empty($user->subscriptions)) {
            $profile->permission = true;
        }
        $profile->levels = Level::orderBy('start_count', 'asc')->get();
        return $profile;
    }

    public function myReferralLink($currentUser)
    {
        if (!$currentUser->promo_code) {
            $currentUser->promo_code = $currentUser->promoCode();
            $currentUser->save();
        }
        return route('promo-code.index', ['promoCode' => $currentUser->promo_code]);
    }

    public function myCertificates()
    {
        $user = Auth::user();
        $certificates = $user->certificates;
        $results = array();
        foreach ($certificates as $certificate) {
            $course = $certificate->course;
            $result = (object)array();
            $result->id = $course->id;
            $result->title = $course->title;
            $result->lessons_count = $course->lessons->count();
            $result->image_path = $course->image_path;
            $result->author = $course->author ? array('id' => $course->author->id, 'name' => $course->author->name,
                'surname' => $course->author->surname, 'father_name' => $course->author->father_name) : null;
            $results[] = $result;
        }
        return $results;
    }

    public function myMarketingMaterials()
    {
        return MarketingMaterial::all();
    }


}
