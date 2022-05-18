<?php

namespace App\Repositories;

use App\Interfaces\ClientInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientInterface
{
    /**
     * @param Client $model
     */
    public function __construct(private Client $model)
    {

    }

    /**
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     */
    public function index(bool $all): LengthAwarePaginator|Collection
    {
        return !$all ? $this->model->with('purchases')->paginate(10) : $this->model->with('purchases')->get();
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function getPurchases($id): Model|null
    {
        return $this->model->with('purchases')->find($id);
    }

    /**
     * @param int $id
     * @return Client
     */
    public function find(int $id): Client
    {
        return $this->model->findOrFail($id);
    }
}
