<?php

namespace App\Http\Controllers;

use App\Services\SecurityService\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SecurityController extends Controller
{
    public function __construct(
        private SecurityService $service
    )
    {
    }

    public function index(Request $request): Response
    {
        return response($this->service->get($request->input('query')));
    }
}
