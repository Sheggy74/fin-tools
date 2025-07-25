<?php

namespace App\Services\ReferenceService;

use App\Services\ReferenceService\DTO\CommonReferenceDTO;
use App\Services\ReferenceService\DTO\TypeDTO;
use App\Services\ReferenceService\Repository\IReferenceRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReferenceService
{
    private CommonReferenceDTO $reference;


    /**
     * @param IReferenceRepository $repository
     */
    public function __construct(
        private IReferenceRepository $repository,
        private LoggerInterface $logger
    )
    {
        $this->setReference();
    }


    public function getTypeById(string $idType) : TypeDTO
    {
        $types = array_values(array_filter($this->reference->getTypes(), function ($item) use ($idType) {
            return $item->getId() == $idType;
        }));
        if(count($types) == 0){
            $this->logger->error("Тип с идентификатором {$idType} не найден!");
            throw new NotFoundHttpException("Тип с идентификатором {$idType} не найден!");
        }
        return $types[0];
    }

    private function setReference()
    {
        $this->reference = $this->repository->getReference();
    }
}