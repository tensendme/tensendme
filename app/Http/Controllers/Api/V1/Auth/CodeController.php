<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\Auth\CheckCodeApiRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordApiRequest;
use App\Http\Requests\Api\V1\Auth\SendCodeApiRequest;
use App\Services\v1\CodeService;

class CodeController extends ApiBaseController
{
    protected $codeService;

    /**
     * CodeController constructor.
     * @param $codeService
     */
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function sendCode(SendCodeApiRequest $request)
    {
        $phone = $request->phone;
        $email = $request->email;
        if ($phone) {
            $this->codeService->createAndSendCode($phone);
        } else {
            $this->codeService->createAndSendCode($email, true);
        }
        return $this->successResponse(['message' => 'Code sent']);
    }

    public function checkCode(CheckCodeApiRequest $request)
    {
        $login = $request->login;
        $code = $request->code;
        $isRight = $this->codeService->checkCode($login, $code);
        return $this->successResponse(['is_right' => $isRight]);
    }

    public function resetCode(ResetPasswordApiRequest $request)
    {
        $phone = $request->phone;
        $email = $request->email;
        $code = $request->code;
        $password = $request->password;
        if ($phone) {
            $token = $this->codeService->resetPassword($phone, $password, $code, false);
        } else {
            $token = $this->codeService->resetPassword($email, $password, $code, true);
        }
        return $this->successResponse(['token' => $token]);
    }
}