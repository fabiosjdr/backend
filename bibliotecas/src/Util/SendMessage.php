<?php

namespace Fabio\Bibliotecas\Util;

//require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendMessage{

    private  $connection;
    private  $channel;
    private $callback_queue;
    private $response;
    private $corr_id;


    public function __construct()
    {
       $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
       $this->channel = $this->connection->channel();

       //$this->channel->queue_declare('hello', false, false, false, false);

       //list($this->callback_queue, ,) = $this->channel->queue_declare("",false,false,true,false);
       //$this->channel->basic_consume( $this->callback_queue,'',false,true,false,false, array($this,'onResponse'));
    }   


    public function send(string $txt){

        $this->channel->queue_declare('hello', false, false, false, false);
       
        $msg = new AMQPMessage($txt);
        $this->channel->basic_publish($msg, '', 'hello');

        echo " [x] Sent '$txt'\n";

        $this->channel->close();
        $this->connection->close();
    }

    public function receive(){

        $this->channel->queue_declare('rpc_queue', false, false, false, false);
        
        $callback = function ($req) {

            $msg = new AMQPMessage(
                (string) $req->body,
                array('correlation_id' => $req->get('correlation_id'))
            );
            
            $req->delivery_info['channel']->basic_publish(
                $msg,
                '',
                $req->get('reply_to')
            );

            $req->ack();
        };
        
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume('rpc_queue', '', false, false, false, false, $callback);

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();
       
    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function call($n)
    {

       $this->channel->queue_declare('rpc_queue', false, false, false, false);

       list($this->callback_queue, ,) = $this->channel->queue_declare("",false,false,true,false);
       $this->channel->basic_consume( $this->callback_queue,'',false,true,false,false, array($this,'onResponse'));

        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string) $n,
            array(
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue
            )
        );
        $this->channel->basic_publish($msg, '', 'rpc_queue');
        while (!$this->response) {
            $this->channel->wait();
        }
        return $this->response;
    }

   
}