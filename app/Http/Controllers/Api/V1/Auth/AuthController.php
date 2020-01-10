<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\ApiServiceException;
use App\Http\Controllers\ApiBaseController;
use App\Http\Errors\ErrorCode;
use App\Http\Requests\Api\V1\Auth\LoginApiRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiBaseController
{

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
