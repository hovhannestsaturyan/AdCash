<?php

namespace App\Http\Controllers;

use App\Entities\StoreStockEntity;
use App\Entities\UpdateStockEntity;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Resources\StocksCollection;
use App\Http\Resources\StocksResource;
use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class StockController extends Controller
{
    public function __construct(private StockService $stockService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return StocksCollection
     */
    public function index(Request $request): StocksCollection
    {
        $all = $request->get('all')?:false;
        return new StocksCollection($this->stockService->index($all));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStockRequest $request
     * @return string
     * @throws UnknownProperties
     */
    public function store(StoreStockRequest $request): string
    {
        $StoreClientEntity = new StoreStockEntity($request->validated());
        return $this->stockService->store($StoreClientEntity);
    }

    /**
     * Display the specified resource.
     *
     * @param Stock $stock
     * @return StocksResource
     */
    public function show(Stock $stock): StocksResource
    {
        return StocksResource::make($stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStockRequest $request
     * @param Stock $stock
     * @return string
     * @throws UnknownProperties
     */
    public function update(UpdateStockRequest $request, Stock $stock): string
    {
        $UpdateClientEntity = new UpdateStockEntity($request->validated());

        return $this->stockService->update($UpdateClientEntity, $stock);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stock $stock
     * @return string
     */
    public function destroy(Stock $stock): string
    {
        return $this->stockService->destroy($stock);
    }
}
