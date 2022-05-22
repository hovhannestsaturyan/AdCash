<?php

namespace App\Services;

use App\Constants\MessagesConstant;
use App\Entities\StoreStockEntity;
use App\Entities\UpdateStockEntity;
use App\Interfaces\StockInterface;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class StockService
{
    /**
     * @param StockInterface $stock
     */
    public function __construct(private StockInterface $stock)
    {
    }

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection
    {
        return $this->stock->index($all);
    }

    /**
     * @param StoreStockEntity $data
     * @return string
     */
    public function store(StoreStockEntity $data): string
    {
        $stock = new Stock;
        $stock->name = $data->getName();
        $stock->unit_price = $data->getUnitPrice();
        $savedStock = $stock->save();
        if (!$savedStock) {
            App::abort(500, MessagesConstant::GOES_WRONG);
        } else {
            return MessagesConstant::ADDED;
        }
    }

    /**
     * @param UpdateStockEntity $data
     * @param Stock $stock
     * @return string
     */
    public function update(UpdateStockEntity $data, Stock $stock): string
    {
        $stock->unit_price = $data->getUnitPrice();
        $savedStock = $stock->save();
        if (!$savedStock) {
            App::abort(500, MessagesConstant::GOES_WRONG);
        } else {
            Log::notice("Stock with id $stock->id changed price to {$data->getUnitPrice()}");
            return MessagesConstant::UPDATED;
        }
    }

    /**
     * @param Stock $stock
     * @return string
     */
    public function destroy(Stock $stock): string
    {
        $deleted = $stock->delete();
        if (!$deleted) {
            App::abort(500, MessagesConstant::GOES_WRONG);
        } else {
            return MessagesConstant::DELETED;
        }
    }
}
