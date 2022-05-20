<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testClientIndex()
    {
        $response = $this->get('api/clients')->assertStatus(200);
    }

    public function testClientStoreValidation()
    {
        $wrongData = [
            'name' => '',
        ];
        $this->post('/api/clients', $wrongData, ['Accept' => 'application/json'])
            ->assertStatus(422);
        $this->assertDatabaseMissing('clients', $wrongData);
    }

    public function testClientStore()
    {
        $data = [
            'name' => 'John Conor',
        ];
        $response = $this->post('/api/clients', $data, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
