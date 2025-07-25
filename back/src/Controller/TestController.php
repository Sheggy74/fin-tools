<?php

namespace App\Controller;

use App\Services\SecurityService\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request, SecurityService $service)
    {
        $http = new CurlHttpClient();
        $res = $http->request('GET', 'http://logstash:5044/');
        return $res;
    }
}




