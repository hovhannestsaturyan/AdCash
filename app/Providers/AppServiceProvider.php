<?php

namespace App\Providers;

use App\Interfaces\ClientInterface;
use App\Interfaces\PurchaseStockInterface;
use App\Interfaces\StockInterface;
use App\Repositories\ClientRepository;
use App\Repositories\PurchaseStockRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientInterface::class, ClientRepository::class);
        $this->app->bind(StockInterface::class, StockRepository::class);
        $this->app->bind(PurchaseStockInterface::class, PurchaseStockRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
