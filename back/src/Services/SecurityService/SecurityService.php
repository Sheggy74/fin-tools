<?php

namespace App\Services\SecurityService;


use App\Services\SecurityService\DTO\SecurityDTO;
use App\Services\SecurityService\Repository\ISecurityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SecurityService
{
    private ISecurityRepository $repository;

    public function __construct(ISecurityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSecurities(string $query): JsonResponse
    {
        $data = $this->repository->getSecurities($query);

        return new JsonResponse(['data' => array_map(fn(SecurityDTO $item) => $item->toArray(),$data->toArray())], Response::HTTP_OK);
    }

}