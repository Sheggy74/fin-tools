<?php

namespace App\Services\SecurityService\UseCases;

use App\Services\ReferenceService\ReferenceService;
use App\Services\SecurityService\DTO\SecurityDTO;
use Doctrine\Common\Collections\ArrayCollection;

class XmlToDTOConverter
{

    public function __construct(
        private ReferenceService $referenceService
    )
    {

    }

    public function convert(string $xml) : ArrayCollection {
        $obj = simplexml_load_string($xml);
        $data = [];
        foreach ($obj->data->rows->row as $row) {
            $data[] = $this->convertItem($row);
        }
        return new ArrayCollection($data);
    }

    private function convertItem($item) : SecurityDTO
    {
        return new SecurityDTO(
            (string)$item->attributes()->secid,
            (string)$item->attributes()->shortname,
            (string)$item->attributes()->regnumber,
            (string)$item->attributes()->name,
            (string)$item->attributes()->isin,
            ((int)$item->attributes()->is_traded) === 1,
            (int)$item->attributes()->emitent_id,
            (string)$item->attributes()->emitent_title,
            (int)$item->attributes()->emitent_inn,
            (string)$item->attributes()->emitent_okpo,
            $this->referenceService->getTypeById((string)$item->attributes()->type),
            (string)$item->attributes()->group
        );
    }
}