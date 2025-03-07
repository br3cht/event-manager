<?php

namespace App\Console\Commands;

use App\Services\EventService;
use Illuminate\Console\Command;

class FinishEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:finish-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = resolve(EventService::class);
        $service->finisheEvent();
    }
}
