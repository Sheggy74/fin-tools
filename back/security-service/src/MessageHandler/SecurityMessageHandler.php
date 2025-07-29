<?php

namespace App\MessageHandler;

use App\Message\SecurityMessage;
use App\Services\SecurityService\SecurityService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SecurityMessageHandler
{
    public function __construct(
        private LoggerInterface $logger,
        private SecurityService $securityService
    )
    {
    }

    public function __invoke(SecurityMessage $message)
    {
//
        $data = $message->getData()['body'];
//
        $this->logger->info(sprintf('Отбираем ценные бумаги по запросу: %s', $data['query']));




        if (!empty($message['reply_queue']))
        {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);
//
            $channel = $connection->channel();
            $response = $this->service->getSecurities($data['query']);
            $channel->basic_publish(new AMQPMessage($response, [
                'correlation_id' => $message['correlation_id']]), '', $message['reply_queue']);
            $channel->close();
            $connection->close();
        }




    }
}