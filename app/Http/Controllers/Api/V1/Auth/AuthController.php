<?php
/**
 * @license Apache 2.0
 */

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\Auth\CheckLoginExistenceApiRequest;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;
use App\Http\Requests\Api\V1\Auth\RegisterApiRequest;
use App\Http\Requests\Api\V1\Auth\SetDeviceTokenApiRequest;
use App\Services\v1\AuthService;
use Illuminate\Support\Facades\Auth;


class AuthController extends ApiBaseController
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginApiRequest $request)
    {
        return $this->successResponse(['token' => $this->authService->login($request)]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();
        return $this->successResponse(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->successResponse(['token' => (auth()->refresh())]);
    }

    public function register(RegisterApiRequest $request)
    {
        return $this->successResponse(['token' => $this->authService->register($request)]);
    }

    public function checkLogin(CheckLoginExistenceApiRequest $request)
    {
        return $this->successResponse(['is_exists' => $this->authService->checkLoginExistence($request)]);
    }

    public function setDeviceToken(SetDeviceTokenApiRequest $request)
    {
        $this->authService->setDeviceToken(Auth::user(), $request->device_token, $request->platform);
        return $this->successResponse(['message' => 'Device token set']);
    }

}
