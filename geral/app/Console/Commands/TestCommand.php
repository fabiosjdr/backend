<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executar TestJob com exemplo de uso do RabbitMQ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        TestJob::dispatch();
    }
}
