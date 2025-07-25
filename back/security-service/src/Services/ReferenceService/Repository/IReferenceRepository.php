<?php

namespace App\Services\ReferenceService\Repository;

use App\Services\ReferenceService\DTO\CommonReferenceDTO;

interface IReferenceRepository
{
    public function getReference(): CommonReferenceDTO;
}