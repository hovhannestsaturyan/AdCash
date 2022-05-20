<?php

namespace App\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class StoreStockEntity extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var float
     */
    public float $unit_price;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unit_price;
    }

    /**
     * @param float $unit_price
     */
    public function setUnitPrice(float $unit_price): void
    {
        $this->unit_price = $unit_price;
    }
}
