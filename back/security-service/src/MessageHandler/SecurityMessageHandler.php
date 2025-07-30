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
        $data = json_decode($message->getData()['body'],true);
//
        $logMessage = sprintf('Отбираем ценные бумаги по запросу: %s', $data['query']);
        $this->logger->info($logMessage);




        if (!empty($data['reply_queue']))
        {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);
//
            $channel = $connection->channel();
            $response = $this->securityService->getSecurities($data['query']);
            $channel->basic_publish(new AMQPMessage(json_encode($response), [
                'correlation_id' => $data['correlation_id']]), '', $data['reply_queue']);
            $channel->close();
            $connection->close();
        }




    }
}