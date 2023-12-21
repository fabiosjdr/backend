<?php

namespace App\Jobs;

use Closure;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AmqpBaseJob
{
    private AMQPStreamConnection $rabbitConnection;
    private AMQPChannel $channel;

    protected function init(string $host, int $port, string $user, string $password): void
    {
        $this->rabbitConnection = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $this->rabbitConnection->channel();
    }

    protected function configureChannel(string $queue, Closure $callback): void
    {
        $this->channel->queue_declare($queue, false, false, false, false);

        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume($queue, '', false, false, false, false, $callback);

        /* while ($this->channel->is_open()) {
            $this->channel->wait();
        } */
        
        $this->channel->consume();
    }

    public function sendMessage(array $msg, $req): void
    {
        $msg = new AMQPMessage(
            json_encode($msg),
            array('correlation_id' => $req->get('correlation_id'))
        );
        $req->delivery_info['channel']->basic_publish(
            $msg,
            '',
            $req->get('reply_to')
        );
    }

    protected function shutdown(): void
    {
        $this->channel->close();
        $this->rabbitConnection->close();
    }
}