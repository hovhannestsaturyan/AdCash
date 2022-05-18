<?php

namespace App\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class PurchaseStockEntity extends DataTransferObject
{
    /**
     * @var int
     */
    public int $stock_id;
    /**
     * @var int
     */
    public int $client_id;
    /**
     * @var int
     */
    public int $value;

    /**
     * @return int
     */
    public function getStockId(): int
    {
        return $this->stock_id;
    }

    /**
     * @param int $stock_id
     */
    public function setStockId(int $stock_id): void
    {
        $this->stock_id = $stock_id;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     */
    public function setClientId(int $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
