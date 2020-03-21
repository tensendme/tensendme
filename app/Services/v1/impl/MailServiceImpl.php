<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 21.01.2020
 * Time: 22:20
 */

namespace App\Services\v1\impl;


use App\JobTemplates\MailJobTemplate;
use App\Services\v1\MailService;
use Illuminate\Support\Facades\Mail;

class MailServiceImpl implements MailService
{
    public function sendEmail($to, string $message, $title = null)
    {
        Mail::send('mail.mail', ['data' => compact('message')], function ($msg) use ($to) {
            $msg->to($to, 'Tensend me')
                ->subject('Код авторизации');
        });
    }

    public function sendEmailByMailJob(MailJobTemplate $mailJobTemplate)
    {
        $this->sendEmail(
            $mailJobTemplate->getTo(),
            $mailJobTemplate->getMessage(),
            $mailJobTemplate->getTitle());
    }


}