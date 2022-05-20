<?php

namespace App\Interfaces;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClientInterface
{
    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function getPurchases(int $id): Model|null;

    /**
     * @param int $id
     * @return Client
     */
    public function find(int $id): Client;
}
