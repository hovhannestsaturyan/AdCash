<?php

namespace App\Services;

use App\Constants\LocationConstant;
use App\Constants\MessagesConstant;
use App\Entities\StoreClientEntity;
use App\Interfaces\ClientInterface;
use App\Models\Client;
use Brooklyn\Exceptions\UniversalException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ClientService
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection
    {
        return $this->client->index($all);
    }

    /**
     * @param StoreClientEntity $data
     * @return Client
     */
    public function store(StoreClientEntity $data): string
    {
        $client = new Client;
        $client->name = $data->getName();
        $savedClient = $client->save();
        if (!$savedClient) {
            App::abort(500, MessagesConstant::GOES_WRONG);
        }else{
            Log::notice("Added new client {$data->getName()}");
            return MessagesConstant::ADDED;
        }
    }

    /**
     * @param $id
     * @return Model|null
     * @throws UniversalException
     */
    public function getPurchases($id): Model|null
    {
        $response = $this->client->getPurchases($id);
        if(!$response){
            throw new UniversalException(MessagesConstant::DOES_NOT_EXIST, LocationConstant::CLIENT_CONTROLLER, 404);
        }
        return $this->client->getPurchases($id);
    }
}
