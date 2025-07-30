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

    public function getSecurities(string $query): array
    {
        $data = $this->repository->getSecurities($query);

        return array_map(fn(SecurityDTO $item) => $item->toArray(),$data->toArray());
    }

}