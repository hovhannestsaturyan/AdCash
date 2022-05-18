<?php

namespace App\Services;

use App\Constants\LocationConstant;
use App\Constants\MessagesConstant;
use App\Entities\PurchaseStockEntity;
use App\Interfaces\ClientInterface;
use App\Interfaces\StockInterface;
use App\Models\PurchaseStock;
use Brooklyn\Exceptions\UniversalException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PurchaseStockService
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(private ClientInterface $client, private StockInterface $stock)
    {
    }

    /**
     * @param PurchaseStockEntity $data
     * @return string
     * @throws UniversalException
     */
    public function purchase(PurchaseStockEntity $data): string
    {
        $client = $this->client->find($data->getClientId());

        if ($client->cash_balance < ($data->getValue() * $this->stock->getPrice($data->getStockId())->unit_price)) {
            throw new UniversalException(MessagesConstant::NOT_ENOUGH, LocationConstant::STOCK_SERVICE, 402);
        }

        $purchaseStock = new PurchaseStock();
        $purchaseStock->client_id = $data->getClientId();
        $purchaseStock->purchase_price = $this->stock->getPrice($data->getStockId())->unit_price;
        $purchaseStock->stock_id = $data->getStockId();
        $purchaseStock->value = $data->getValue();
        $purchaseStockSaved = $purchaseStock->save();
        if (!$purchaseStockSaved) {
            App::abort(500, MessagesConstant::GOES_WRONG);
        } else {
            $client->cash_balance = $client->cash_balance - ($data->getValue() * $this->stock->getPrice($data->getStockId())->unit_price);
            $clientSaved = $client->save();
            if (!$clientSaved) {
                App::abort(500, MessagesConstant::GOES_WRONG);
            } else {
                Log::notice("Client with id {$data->getClientId()} purchased stocks with id {$data->getStockId()} . ");
                return MessagesConstant::ADDED;
            }
        }
    }
}
