<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 21.01.2020
 * Time: 20:42
 */

namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Http\Requests\Api\V1\Auth\CheckLoginExistenceApiRequest;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;
use App\Http\Requests\Api\V1\Auth\RegisterApiRequest;
use App\Http\Utils\ApiUtil;
use App\Models\Profiles\City;
use App\Models\Profiles\Level;
use App\Models\Profiles\Role;
use App\Models\Profiles\User;
use App\Services\v1\AuthService;
use App\Services\v1\FollowerService;
use App\Services\v1\SubscriptionService;
use App\Utils\StaticConstants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class AuthServiceImpl implements AuthService
{
    protected $subscriptionService;
    protected $followerService;

    public function __construct(SubscriptionService $subscriptionService, FollowerService $followerService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->followerService = $followerService;
    }

    public function login(LoginApiRequest $request)
    {
        $user = null;
        if ($request->has('phone')) {
            $user = User::where('phone', $request->input('phone'))
                ->first();
        } else if ($request->has('email')) {
            $user = User::where('email', $request->input('email'))
                ->first();
        }

        if (!$user) {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'provide with login or password'
                ],
                'errorCode' => ErrorCode::INVALID_ARGUMENT
            ]);
        }


        if (!$this->checkPassword($request->password, $user->password)) {
            throw new ApiServiceException(401, false, [
                'errors' => [
                    'Invalid login or password'
                ],
                'errorCode' => ErrorCode::UNAUTHORIZED
            ]);
        }
        $user->current_token = ApiUtil::generateTokenFromUser($user);
        $user->save();

        $this->setDeviceToken($user, $request->device_token, $request->platform);
        $mobileUser = (object)array();
        $mobileUser->token = $user->current_token;
        $mobileUser->name = $user->name;
        $mobileUser->surname = $user->surname;
        $mobileUser->nickname = $user->nickname;
        $mobileUser->avatar = $user->image_path;
        return $mobileUser;
    }

    public function register(RegisterApiRequest $request)
    {
        $user = null;
        if ($request->has('city_id')) {
            $city = City::find($request->city_id);
            if (!$city) throw new ApiServiceException(404, false, [
                'errors' => [
                    'Город не найден!'
                ],
                'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
            ]);
        }
        $level = Level::where('start_count', 0)->first();
        $user = new User();
        $user->password = bcrypt($request->password);
        $user->remember_token = '';
        $user->level_id = $level->id;
        $user->role_id = Role::USER_ID;
        $user->name = $request->name;
        $user->current_token = '';
        $user->nickname = $request->nickname;
        $user->image_path = StaticConstants::DEFAULT_AVATAR;
        $user->promo_code = $user->promoCode();
        $user->city_id = $request->city_id ? $request->city_id : 1;
        if ($request->has('phone')) {
            $user->phone = $request->phone;
            //VerifyPhone
        } else if ($request->has('email')) {
            $user->email = $request->email;
            //VerifyEmail
        }
        $user->save();
        if ($user->phone)
            $this->followerService->promoFollow($user->phone, $user->id);

        if (!$user) {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'User not created'
                ],
                'errorCode' => ErrorCode::INVALID_FIELD
            ]);
        }

        $user->current_token = ApiUtil::generateTokenFromUser($user);
        if (!$user->current_token) {
            throw new ApiServiceException(401, false, [
                'errors' => [
                    'Invalid login or password'
                ],
                'errorCode' => ErrorCode::UNAUTHORIZED
            ]);
        }

        $user->save();
        // create free subscription
        if ($user->phone == '77001234567') {
            $this->subscriptionService->freeSubscribe($user->id);
        }
//        $this->subscriptionService->freeSubscribe($user->id);
        //create balance
        $user->getBalance();
        $this->setDeviceToken($user, $request->device_token, $request->platform);
        return $user->current_token;
    }

    public function checkEmailExistence($email): bool
    {
        return !!User::where('email', '=', $email)->first();
    }

    public function checkPhoneExistence($phone): bool
    {
        return !!User::where('phone', '=', $phone)->first();
    }

    public function checkLoginExistence(CheckLoginExistenceApiRequest $request): bool
    {
        if ($request->has('email')) {
            return $this->checkEmailExistence($request->email);
        } else if ($request->has('phone')) {
            return $this->checkPhoneExistence($request->phone);
        } else {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'Provide with email or phone number'
                ],
                'errorCode' => ErrorCode::REQUIRED_PARAMS_NOT_FOUND
            ]);
        }
    }

    public function checkPassword($password, $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }

    public function setDeviceToken($user, $deviceToken, $platform)
    {
        DB::beginTransaction();
        try {
//            User::find('device_token', $deviceToken)->update([
//                'device_token' => null,
//                'platform' => null
//            ]);
            $user->update([
                'device_token' => $deviceToken,
                'platform' => $platform
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'Error occured when updating device token',
                    $exception->getMessage()
                ],
                'errorCode' => ErrorCode::SYSTEM_ERROR
            ]);
        }
    }

    public function authorizedResetPassword($user, $password, $new_password)
    {

        if (Hash::check($password, $user->password)) {
            $user->password = bcrypt($new_password);
            $user->save();
        } else {
            throw new ApiServiceException(400, false, [
                'errorCode' => ErrorCode::PASSWORDS_MISMATCH,
                'errors' => [
                    'Password does not match'
                ]
            ]);
        }
    }


}
