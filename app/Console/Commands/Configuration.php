<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Configuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tensend:configure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure tensend project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('optimize');
        $this->line('<fg=green>Tensend optimized');
        Artisan::call('config:clear');
        $this->line('<fg=green>Tensend config cleared');
        return;
    }

}
