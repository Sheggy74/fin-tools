<?php

namespace App\Services\LogService;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class LogService implements LoggerInterface
{
    private function send(string $logLevel, string $message)
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);
        $channel = $connection->channel();
        $channel->queue_declare('log_queue', false, true, false, false);
        $msg = new AMQPMessage(json_encode([
            'message' => $message,
            'service' => 'security_service',
            'user' => 'user',
            'log_level' => $logLevel
        ]));
        $channel->basic_publish($msg, '', 'log_queue');
        $channel->close();
        $connection->close();
    }

    public function info(string|\Stringable $message, mixed $context = []): void
    {
        $this->send('info', $message);
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        $this->send('emergency', $message);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        $this->send('alert', $message);
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        $this->send('critical', $message);
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->send('error', $message);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->send('warning', $message);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->send('notice', $message);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        $this->send('debug', $message);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->send('log', $message);
    }
}