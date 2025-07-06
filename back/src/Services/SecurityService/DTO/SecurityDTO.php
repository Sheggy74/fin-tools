<?php

namespace App\Services\SecurityService\DTO;

use App\Services\ReferenceService\DTO\TypeDTO;

class SecurityDTO
{
    private string $id;
    private string $shortName;
    private string $regNumber;
    private string $name;
    private string $isIn;
    private bool $isTraded;
    private int $emitentId;
    private string $emitentName;
    private int $emitentINN;
    private string $emitentOkpo;
    private TypeDTO $type;
    private string $group;

    /**
     * @param string $id
     * @param string $shortName
     * @param string $regNumber
     * @param string $name
     * @param string $isIn
     * @param bool $isTraded
     * @param int $emitentId
     * @param string $emitentName
     * @param int $emitentINN
     * @param string $emitentOkpo
     * @param TypeDTO $type
     * @param string $group
     */
    public function __construct(string $id, string $shortName, string $regNumber, string $name, string $isIn, bool $isTraded, int $emitentId, string $emitentName, int $emitentINN, string $emitentOkpo, TypeDTO $type, string $group)
    {
        $this->id = $id;
        $this->shortName = $shortName;
        $this->regNumber = $regNumber;
        $this->name = $name;
        $this->isIn = $isIn;
        $this->isTraded = $isTraded;
        $this->emitentId = $emitentId;
        $this->emitentName = $emitentName;
        $this->emitentINN = $emitentINN;
        $this->emitentOkpo = $emitentOkpo;
        $this->type = $type;
        $this->group = $group;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function getRegNumber(): string
    {
        return $this->regNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIsIn(): string
    {
        return $this->isIn;
    }

    public function isTraded(): bool
    {
        return $this->isTraded;
    }

    public function getEmitentId(): int
    {
        return $this->emitentId;
    }

    public function getEmitentName(): string
    {
        return $this->emitentName;
    }

    public function getEmitentINN(): int
    {
        return $this->emitentINN;
    }

    public function getEmitentOkpo(): string
    {
        return $this->emitentOkpo;
    }

    public function getType(): TypeDTO
    {
        return $this->type;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'shortName' => $this->shortName,
            'regNumber' => $this->regNumber,
            'name' => $this->name,
            'isIn' => $this->isIn,
            'isTraded' => $this->isTraded,
            'emitentId' => $this->emitentId,
            'emitentName' => $this->emitentName,
            'emitentINN' => $this->emitentINN,
            'emitentOkpo' => $this->emitentOkpo,
            'type' => $this->type->getName(),
            'group' => $this->group
        ];
    }

}