<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 21.01.2020
 * Time: 20:42
 */

namespace App\Services\v1;


use App\Http\Requests\Api\V1\Auth\CheckLoginExistenceApiRequest;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;
use App\Http\Requests\Api\V1\Auth\RegisterApiRequest;

interface AuthService
{
    public function login(LoginApiRequest $request);

    public function register(RegisterApiRequest $request);

    public function checkLoginExistence(CheckLoginExistenceApiRequest $request): bool;

    public function checkEmailExistence($email): bool;

    public function checkPhoneExistence($phone): bool;

    public function checkPassword($password, $hashedPassword): bool;

    public function setDeviceToken($user, $deviceToken, $platform);

    public function authorizedResetPassword($user, $password, $new_password);
}