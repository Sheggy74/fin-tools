<?php

namespace App\Services\SecurityService\Repository;

interface ISecurityRepository
{
    public function getSecurities(string $query): array;
}
