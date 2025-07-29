<?php

namespace App\Serializer;

use App\Message\SecurityMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class CustomSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $msg = new SecurityMessage($encodedEnvelope);
        return new Envelope($msg);
    }

    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        return [
            'body' => json_encode(['data' => $message->getData()]),
            'headers' => [
                'Content-Type' => 'application/json',
                'type' => get_class($message),
            ],
        ];
    }
}