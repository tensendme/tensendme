<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\WithUser;
use App\Http\Utils\ResponseUtil;
use Illuminate\Support\Facades\Auth;
/**
 * @SWG\Swagger(
 *     basePath="/api/v1",
 *     schemes={"http", "https"},
 *     host=L5_SWAGGER_CONST_HOST,
 *     @SWG\Info(
 *         version="2.0.0",
 *         title="TenSendMe Swagger API",
 *         description="TenSendMe Swagger API description",
 *         @SWG\Contact(
 *             email="tenSendMe@gmail.com"
 *         ),
 *     )
 * )
 */

class ApiBaseController extends Controller implements WithUser
{


    public function makeResponse($code, $success, Array $other)
    {
        return ResponseUtil::makeResponse($code, $success, $other);
    }

    public function successResponse(Array $other)
    {
        return ResponseUtil::makeResponse(200, true, $other);
    }

    public function failedResponse(Array $other)
    {
        return ResponseUtil::makeResponse(400, false, $other);
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getCurrentUserId()
    {
        return Auth::id();
    }

}
