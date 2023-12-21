<?php

namespace App\Console\Commands;

use App\Jobs\ComprasJob;
use Illuminate\Console\Command;

class ComprasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:compras';

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
        ComprasJob::dispatch();
    }
}
