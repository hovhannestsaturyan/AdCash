<?php

namespace App\Repositories;

use App\Interfaces\StockInterface;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return !$all ? $this->model->paginate(10) : $this->model->get();
    }

    /**
     * @param int $id
     * @return Stock|null
     */
    public function getPrice(int $id): Stock|null{
      return  $this->model->select('unit_price')->find($id);
    }
}
