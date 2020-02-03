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

    /**
     * AuthController constructor.
     * @param $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    /**
     * @SWG\Post(
     *     path="/login",
     *     description="Login by login and password to get token and etc",
     *     @SWG\Parameter(
     *         name="email and password",
     *         in="body",
     *         type="string",
     *         description="Login user(phone) or email and password",
     *         required=true,
     * 			@SWG\Schema(ref="#/definitions/User"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Invalid login or password"
     *     )
     * )
     */
    public function login(LoginApiRequest $request)
    {
        return $this->successResponse(['token' => $this->authService->login($request)]);
    }

    /**
     * @SWG\Post(
     *     path="/me",
     *     description="Get user info by token",
     *     @SWG\SecurityScheme(
     *         securityDefinition="Bearer",
     *         type="apiKey",
     *         name="Authorization",
     *         in="header"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
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
