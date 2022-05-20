<?php

namespace App\Http\Controllers;

use App\Entities\StoreClientEntity;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientsCollection;
use App\Services\ClientService;
use Brooklyn\Exceptions\UniversalException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class ClientController extends Controller
{
    /**
     * @param ClientService $clientService
     */
    public function __construct(private ClientService $clientService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ClientsCollection
     */
    public function index(Request $request): ClientsCollection
    {
        $all = $request->get('all')?:false;
        return new ClientsCollection($this->clientService->index($all));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return string
     * @throws UnknownProperties
     */
    public function store(StoreClientRequest $request): string
    {
        $StoreClientEntity = new StoreClientEntity($request->validated());
        return $this->clientService->store($StoreClientEntity);
    }

    /**
     *  Get purchases for a client
     *
     * @param int $id
     * @return Model|null
     * @throws UniversalException
     */
    public function getPurchases(int $id): Model|null
    {
        return $this->clientService->getPurchases($id);
    }
}
