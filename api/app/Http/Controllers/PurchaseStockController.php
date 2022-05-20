<?php

namespace App\Http\Controllers;

use App\Entities\PurchaseStockEntity;
use App\Http\Requests\StorePurchaseStockRequest;
use App\Services\PurchaseStockService;
use Brooklyn\Exceptions\UniversalException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class PurchaseStockController extends Controller
{

    /**
     * @param PurchaseStockService $purchaseStockService
     */
    public function __construct(private PurchaseStockService $purchaseStockService)
    {
    }

    /**
     * @param StorePurchaseStockRequest $request
     * @return string
     * @throws UniversalException|UnknownProperties
     */
    public function purchase(StorePurchaseStockRequest $request): string
    {
        $StoreClientEntity = new PurchaseStockEntity($request->validated());
        return $this->purchaseStockService->purchase($StoreClientEntity);
    }
}
