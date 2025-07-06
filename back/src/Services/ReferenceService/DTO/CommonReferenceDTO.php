<?php

namespace App\Services\ReferenceService\DTO;

class CommonReferenceDTO
{
    /**
     * @var TypeDTO[]
     */
    private array $types;

    /**
     * @param TypeDTO[] $types
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

}