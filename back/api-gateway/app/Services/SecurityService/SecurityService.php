<?php

namespace App\Services\SecurityService;

use App\Services\SecurityService\Repository\ISecurityRepository;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SecurityService
{
    public function __construct(
        private ISecurityRepository $repository
    )
    {
    }

    public function get(string $query) : array
    {
        return [
            'data' => $this->repository->getSecurities($query)
        ];
    }
}
