<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SecurityController extends Controller
{
    public function index(Request $request): Response
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASSWORD']);
        $channel = $connection->channel();

        $queueName = 'security';
        $replyQueueName = 'security_reply';

        list($reply_queue, ,) = $channel->queue_declare($replyQueueName, false, true, false, false);

        $correlation_id = uniqid();

        $response = null;

        $callback = function ($msg) use (&$response, &$correlation_id) {
            if($msg->get('correlation_id') == $correlation_id) {
                $response = $msg->body;
            }
        };

        $channel->basic_consume($replyQueueName, '', false, true, false, false, $callback);

        $messageData = [
            'query' => $request->input('query'),
            'correlation_id' => $correlation_id,
            'reply_queue' => $replyQueueName,
        ];

        $msg = new AMQPMessage(json_encode($messageData),[
        ]);

        $channel->basic_publish($msg, '', $queueName);

        while (!$response) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        return response($response);
    }
}
