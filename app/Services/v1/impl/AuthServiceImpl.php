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
use App\Models\Profiles\Role;
use App\Models\Profiles\User;
use App\Services\v1\AuthService;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function login(LoginApiRequest $request)
    {
        $user = null;
        if ($request->has('phone')) {
            $user = User::where('phone', $request->input('phone'))
                ->first();
        } else if ($request->has('email')) {
            $user = User::where('email', $request->input('email'))
                ->first();
        } else {
            throw new ApiServiceException(401, false, [
                'errors' => [
                    'provide with login or password'
                ],
                'errorCode' => ErrorCode::UNAUTHORIZED
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

        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public function register(RegisterApiRequest $request)
    {
        $user = null;
        if ($request->has('phone')) {
            $user = User::insert([
                [
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'remember_token' => '',
                    'level_id' => 1,
                    'role_id' => Role::USER_ID
                ],
            ]);
        } else if ($request->has('email')) {
            $user = User::insert([
                [
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'remember_token' => '',
                    'level_id' => 1,
                    'role_id' => Role::USER_ID
                ],
            ]);
        }

        if (!$user) {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'User not created'
                ],
                'errorCode' => ErrorCode::INVALID_FIELD
            ]);
        }

        $token = JWTAuth::fromUser($user);
        if (!$token) {
            throw new ApiServiceException(401, false, [
                'errors' => [
                    'Invalid login or password'
                ],
                'errorCode' => ErrorCode::UNAUTHORIZED
            ]);
        }
        return $token;
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


}