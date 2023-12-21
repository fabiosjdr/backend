<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob extends AmqpBaseJob implements ShouldQueue
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

        echo " [x] Awaiting RPC requests\n";

        $callback = function($req) {

            $qtdFuncionarios = (int) $req->body;
            echo ' [.] ' . $qtdFuncionarios . "\n";

            $i = 1;
            while ($i <= $qtdFuncionarios) {
                $qtdCodigos = rand(1, 15);
               // $qtdCodigos = 2;
                $j = 1;
                
                while ($j <= $qtdCodigos) {
                    
                    
                    parent::sendMessage([
                        'sucesso' => true,
                        'indiceFuncionario' => $i,
                        'qtdFuncionarios' => $qtdFuncionarios,
                        'indiceCodigo' => $j,
                        'qtdCodigos' => $qtdCodigos
                    ], $req);
                    
                    sleep(1);
                    
                    $j = $j+1;
                }
                $i++;
            }

            parent::sendMessage([
                'sucesso' => false
            ], $req);
            $req->ack();
        };

        parent::configureChannel('rpc_queue', $callback);

        parent::shutdown();
    }
}
