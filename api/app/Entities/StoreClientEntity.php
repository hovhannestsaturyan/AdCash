<?php

namespace App\Entities;

use Spatie\DataTransferObject\DataTransferObject;

class StoreClientEntity extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

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

}
