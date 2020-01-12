<?php
/**
 * @license Apache 2.0
 */

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\ApiServiceException;
use App\Http\Controllers\ApiBaseController;
use App\Http\Errors\ErrorCode;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends ApiBaseController
{
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
        $token = JWTAuth::attempt($request->all());

        if (!$token) {
            throw new ApiServiceException(401, false, [
                'errors' => [
                    'Invalid login or password'
                ],
                'errorCode' => ErrorCode::UNAUTHORIZED
            ]);
        }
        return $this->successResponse(['token' => $token]);
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

}
