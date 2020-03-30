<?php

namespace App\Jobs;

use App\JobTemplates\VideoCompressJobTemplate;
use App\Services\v1\MaterialService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompressVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $videoCompressJobTemplate;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(VideoCompressJobTemplate $videoCompressJobTemplate)
    {
        $this->videoCompressJobTemplate = $videoCompressJobTemplate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MaterialService $materialService)
    {
        $materialService->videoCompressJob($this->videoCompressJobTemplate);
    }
}
