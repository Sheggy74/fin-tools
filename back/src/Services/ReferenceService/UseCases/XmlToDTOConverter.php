<?php

namespace App\Services\ReferenceService\UseCases;

use App\Services\ReferenceService\DTO\CommonReferenceDTO;
use App\Services\ReferenceService\DTO\TypeDTO;
use App\Services\ReferenceService\ReferenceService;
use App\Services\SecurityService\DTO\SecurityDTO;
use Doctrine\Common\Collections\ArrayCollection;

class XmlToDTOConverter
{

    public function convert(string $xml) : CommonReferenceDTO {
        $obj = simplexml_load_string($xml);

        return new CommonReferenceDTO(
            $this->getTypes($obj)
        );
    }

    private function getTypes($obj) : array
    {
        $typesRef = null;
        foreach ($obj->data as $ref) {
            if($ref->attributes()->id == "securitytypes")
                $typesRef = $ref;
        }
        $types = [];
        foreach ($typesRef->rows->row as $type) {
            $types[] = new TypeDTO($type->attributes()->security_type_name, $type->attributes()->security_type_title);
        }

        return $types;
    }
}