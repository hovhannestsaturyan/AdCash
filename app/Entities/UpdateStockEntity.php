<?php

namespace App\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateStockEntity extends DataTransferObject
{
    /**
     * @var float
     */
    public float $unit_price;

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
