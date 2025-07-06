<?php

namespace App\Controller;

use App\Services\SecurityService\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/security', name: 'securities')]
    public function index(Request $request, SecurityService $service)
    {
        $query = $request->query->get('query');
        return $service->getSecurities($query??'');
    }
}