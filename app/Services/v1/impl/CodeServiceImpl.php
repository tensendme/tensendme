<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.01.2020
 * Time: 12:51
 */

namespace App\Services\v1\impl;


use App\Core\ErrorTrait;
use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Http\Utils\ApiUtil;
use App\Jobs\SendMail;
use App\Jobs\SendSms;
use App\JobTemplates\MailJobTemplate;
use App\JobTemplates\SmsJobTemplate;
use App\Models\Auth\Code;
use App\Models\Profiles\User;
use App\Queues\QueueConstants;
use App\Services\v1\CodeService;
use App\Services\v1\MailService;
use App\Services\v1\SmsService;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class CodeServiceImpl implements CodeService
{
    use ErrorTrait;

    protected $smsService;
    protected $mailService;

    /**
     * CodeServiceImpl constructor.
     * @param $smsService
     */
    public function __construct(SmsService $smsService, MailService $mailService)
    {
        $this->mailService = $mailService;
        $this->smsService = $smsService;
    }


    public function createAndSendCode($login, $isEmail = false)
    {
        DB::beginTransaction();
        try {
            Code::where('login', $login)->delete();
            $code = ApiUtil::generateSmsCode();
            Code::create([
                'login' => $login,
                'code' => $code
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->throwError($exception);
        }

        $text = 'Код авторизации: ';
        $message = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text) . $code;
        if ($isEmail) {
            $emailJobTemplate = new MailJobTemplate($login, $message);
            SendMail::dispatch($emailJobTemplate)->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
//            $this->mailService->sendEmail($login, $message);
        } else {
            $smsJobTemplate = new SmsJobTemplate($login, $message);
            SendSms::dispatch($smsJobTemplate)->onQueue(QueueConstants::NOTIFICATIONS_QUEUE);
//            $this->smsService->sendSms($login, $message);
        }
    }

    public function checkCode($login, $code)
    {
        return !!Code::where('login', '=', $login)
                ->where('code', '=', $code)
                ->first()
            ||
            $code == '0000';
    }

    public function resetPassword($login, $password, $code, $isEmail)
    {
        if (!$this->checkCode($login, $code)) {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'Invalid reset code'
                ],
                'errorCode' => ErrorCode::INVALID_RESET_CODE
            ]);
        }

        $user = null;

        if ($isEmail) {
            $user = User::where('email', '=', $login)->first();
        } else {
            $user = User::where('phone', '=', $login)->first();
        }

        if (!$user) {
            throw new ApiServiceException(400, false, [
                'errors' => [
                    'No users with such login'
                ],
                'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
            ]);
        }
        $user->password = bcrypt($password);
        $user->save();
        $token = JWTAuth::fromUser($user);
        return $token;
    }


}
