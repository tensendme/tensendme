<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\Auth\CheckCodeApiRequest;
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
        $this->codeService->createAndSendCode($phone);
        return $this->successResponse(['message' => 'Code sent']);
    }

    public function checkCode(CheckCodeApiRequest $request)
    {
        $phone = $request->phone;
        $code = $request->code;
        $isRight = $this->codeService->checkCode($phone, $code);
        return $this->successResponse(['is_right' => $isRight]);
    }
}