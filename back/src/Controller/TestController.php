<?php

namespace App\Controller;

use App\Services\SecurityService\SecurityService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request, SecurityService $service)
    {
        $connection = new AMQPStreamConnection('rabbitmq',5672,'user','changeme');
        $channel =  $connection->channel();
        $channel->queue_declare('log_queue', false, true, false, false);
        $msg = new AMQPMessage(json_encode([
            'message' => 'Message from RabbitMQ',
            'service' => 'security_service',
        ]));
        $channel->basic_publish($msg, '', 'log_queue');
        $channel->close();
        $connection->close();
        return new JsonResponse('test');
    }
}




