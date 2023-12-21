<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Fabio\Bibliotecas\RabbitConsumer\RabbitConsumer;

class ComprasJob extends AmqpBaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        parent::init('localhost', 5672, 'guest', 'guest');

        echo " [x] Worker awaiting orders\n";

        $callback = function($req) {
            
            
            $messager =  parent::class;

            $GLOBALS['rabbitConsumer'] = new RabbitConsumer($messager,$req);
            
            $info =  json_decode($req->body);
           
            if($info->module == 'compras'){
                require_once(__DIR__."/../../../compras/vendor/autoload.php");
            }else{
                require_once(__DIR__."/../../vendor/autoload.php");
            }
           
            eval('$TheClass = new \App\Http\Controllers\\'.$info->class.'();');
            
            $TheClass->{$info->function}();

        };

        parent::configureChannel('rpc_queue', $callback);

        parent::shutdown();
    }
}
