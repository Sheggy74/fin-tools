<?php

namespace App\Services\LogService;

use DateTime;
use DateTimeZone;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LogService
{
    private HttpClientInterface $httpClient;
    private string $url;
    public function __construct()
    {
        $this->url = 'http://logstash:5044';
        $this->httpClient = new CurlHttpClient();
    }

    public function info($message){
        $this->log('info', $message);
    }

    private function log(string $logLevel, string $message){
        $connection = new AMQPStreamConnection('rabbitmq',5672,'user','changeme');
        $channel =  $connection->channel();
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
}