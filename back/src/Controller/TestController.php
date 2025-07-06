<?php

namespace App\Controller;

use App\Services\SecurityService\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request, SecurityService $service) : Response
    {
        $query = $request->query->get('query');
        return $service->getSecurities($query??'');
    }
}




