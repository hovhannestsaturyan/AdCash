<?php

namespace App\Interfaces;

use App\Models\Stock;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


interface StockInterface
{

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection ;

    /**
     * @param int $id
     * @return Stock|null
     */
    public function getPrice(int $id): Stock|null;
}
