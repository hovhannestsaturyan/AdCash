<?php

namespace Tests\Feature;

use Faker\Generator as Faker;


use Tests\TestCase;

class StockTest extends TestCase
{
    public function testStockIndex()
    {
        $this->get('api/stocks')->assertStatus(200);
    }

    public function testStockStoreValidation()
    {
        $wrongData = [
            'name' => '',
            'unit_price' => 'text',
        ];
        $this->post('/api/clients', $wrongData, ['Accept' => 'application/json'])
            ->assertStatus(422);
        $this->assertDatabaseMissing('stocks', $wrongData);
    }

    public function testStockStore()
    {
        $data = [
            'name' => 'Google',
            'unit_price' => 31.6,
        ];
        $this->post('/api/stocks', $data, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testStockStoreGreaterThan_0()
    {
        $data = [
            'name' => 'Google',
            'unit_price' => -1,
        ];
        $this->post('/api/stocks', $data, ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    public function testStockShowUndefined()
    {
        $this->get('/api/stocks/10000')
            ->assertStatus(404);
    }

    public function testStockShow()
    {
        $this->get('/api/stocks/1')
            ->assertStatus(200);
    }

    public function testStockUpdate()
    {
        $data = [
            'unit_price' => 10,
        ];
        $this->put('/api/stocks/1', $data, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testStockUpdateUndefined()
    {
        $data = [
            'unit_price' => 12,
        ];
        $this->put('/api/stocks/0', $data, ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    public function testStockUpdateGreaterThan_0()
    {
        $data = [
            'unit_price' => -1,
        ];
        $this->put('/api/stocks/1', $data, ['Accept' => 'application/json'])
            ->assertStatus(422);
    }

    public function testUnavailableBalanceBeforePurchase()
    {
        $data = [
            'stock_id' => 1,
            'client_id' => 1,
            'value' => 10000000000,
        ];
        $this->post('/api/purchase-stock', $data, ['Accept' => 'application/json'])
            ->assertStatus(402);
    }

    public function testUndefinedClientBeforePurchase()
    {
        $data = [
            'stock_id' => 1,
            'client_id' => 1000000000,
            'value' => 1,
        ];
        $this->post('/api/purchase-stock', $data, ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    public function testPurchase()
    {
        $data = [
            'stock_id' => 1,
            'client_id' => 1,
            'value' => 1,
        ];
        $this->post('/api/purchase-stock', $data, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testGetClientPurchases()
    {
        $this->get('/api/stocks/1')
            ->assertStatus(200);
    }
}
