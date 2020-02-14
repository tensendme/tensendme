<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;
use App\Models\Profiles\City;
use App\Models\Profiles\User;
use App\Services\v1\FileService;
use App\Services\v1\ProfileService;
use Auth;

class ProfileServiceImpl implements ProfileService
{
    protected $fileService;

    /**
     * ProfileServiceImpl constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function updateProfile($profile)
    {
        $user = Auth::user();
        if($profile->nickname != $user->nickname) {
            $user->nickname = $profile->nickname;
            $user->promo_code = $user->promoCode();
        }
        $city = City::find($profile->cityId);
        if($city) {
            $user->city_id = $profile->cityId;
        }
        $user->name = $profile->name;
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
        $profile = (object) array();
        $profile->id = $user->id;
        $profile->avatar = $user->image_path;
        $profile->name = $user->name;
        $profile->promoCode = $user->promo_code;
        $profile->created = $user->created_at;
        $profile->level = $user->level->name;
        $profile->levelImage = $user->level->logo;
        $profile->discountPercentage = $user->level->discount_percentage;
        $profile->balance = $user->getBalance()->balance;
        $profile->city = $user->city ? $user->city->name : 'Алматы';
        $profile->role = $user->role->name == 'Author' ? 'Автор' : 'Пользователь';
        $profile->followers_count = $user->followers->count();
        $profile->nickname = $user->nickname;
        $profile->permission = false;
        $profile->analyze = $user->analyze();
        $profile->subscriptions = array();
        foreach ($user->activeSubscriptions as $subscription) {
            $profile->subscriptions[] = array(
                'subscriptionType' => $subscription->subscriptionType->name,
                'price' => $subscription->actual_price,
                'expiredAt' => $subscription->expired_at
                );
        }
        if(!empty($user->subscriptions)) {
            $profile->permission = true;
        }
        return $profile;
    }
}
