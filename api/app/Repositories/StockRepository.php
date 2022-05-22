<?php

namespace App\Repositories;

use App\Interfaces\StockInterface;
use App\Models\Stock;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class StockRepository implements StockInterface
{
    /**
     * @param Stock $model
     */
    public function __construct(private Stock $model)
    {
    }

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection
    {
        return !$all ? $this->model->orderBy('unit_price','desc')->paginate(10) : $this->model->orderBy('unit_price','desc')->get();
    }

    /**
     * @param int $id
     * @return Stock|null
     */
    public function getPrice(int $id): Stock|null{
      return  $this->model->select('unit_price')->find($id);
    }
}
