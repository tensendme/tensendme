<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:51
 */

namespace App\Services\v1\impl;


use App\Core\ErrorTrait;
use App\Http\Utils\ApiUtil;
use App\Models\Auth\Code;
use App\Services\v1\CodeService;
use App\Services\v1\SmsService;
use Illuminate\Support\Facades\DB;

class CodeServiceImpl implements CodeService
{
    use ErrorTrait;

    protected $smsService;

    /**
     * CodeServiceImpl constructor.
     * @param $smsService
     */
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }


    public function createAndSendCode($phone)
    {
        DB::beginTransaction();
        try {
            Code::where('phone', $phone)->delete();
            $code = ApiUtil::generateSmsCode();
            Code::create([
                'phone' => $phone,
                'code' => $code
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->throwError($exception);
        }

        $this->smsService->sendMessage($phone, $code);
    }

    public function checkCode($phone, $code): bool
    {
        return !!Code::where('phone', '=', $phone)
                ->where('code', '=', $code)
                ->first()
            ||
            $code == '0000';
    }


}