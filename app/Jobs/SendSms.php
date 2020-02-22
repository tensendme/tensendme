<?php

namespace App\Jobs;

use App\JobTemplates\SmsJobTemplate;
use App\Services\v1\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $smsJobTemplate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsJobTemplate $smsJobTemplate)
    {
        $this->smsJobTemplate = $smsJobTemplate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsService $smsService)
    {
        $smsService->sendSmsBySmsJob($this->smsJobTemplate);
    }
}
