<?php

namespace App\Services\SecurityService\Repository;

use Doctrine\Common\Collections\ArrayCollection;

interface ISecurityRepository
{
    public function getSecurities(string $query): ArrayCollection;
}