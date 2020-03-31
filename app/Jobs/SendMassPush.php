<?php

namespace App\Jobs;

use App\JobTemplates\MassPushJobTemplate;
use App\Services\v1\PushService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMassPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pushJobTemplate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MassPushJobTemplate $pushJobTemplate)
    {
        $this->pushJobTemplate = $pushJobTemplate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PushService $pushService)
    {
        $pushService->sendMassPushByPushJobTemplate($this->pushJobTemplate);
    }
}
