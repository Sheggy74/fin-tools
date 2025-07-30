<?php

namespace App\Services\SecurityService\Repository;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SecurityRepositoryRPC implements ISecurityRepository
{
        public function getSecurities(string $query) : array
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

            $messageData = [
                'query' => $query,
                'correlation_id' => $correlation_id,
                'reply_queue' => $replyQueueName,
            ];

            $msg = new AMQPMessage(json_encode($messageData),[
            ]);

            $channel->basic_publish($msg, '', $queueName);
            $channel->basic_consume($replyQueueName, '', false, true, false, false, $callback);

            while (!$response) {
                $channel->wait();
            }

            $channel->close();
            $connection->close();

            return json_decode($response,true);
        }
}
