<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PurchaseStockController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('clients',ClientController::class);
Route::apiResource('stocks',StockController::class);
Route::get('clients/get-purchases/{id}', [ClientController::class, 'getPurchases']);

Route::controller(PurchaseStockController::class)->group(function () {
    Route::post('/purchase-stock', 'purchase');
});
