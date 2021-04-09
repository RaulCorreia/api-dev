<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     *
     * @return void
     */
    public function getAllTypeTest(): void
    {
        $this->get('/api/type')->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Produto de limpeza',
                'name' => 'Alimentação',
            ]);
    }


    /**
     * @test
     *
     * @return void
     */
    public function createTypeTest(): void
    {
        $response = $this->post('/api/type', [
            'name' => 'type_test',
        ])->assertStatus(200);

        $response = json_decode($response->getContent());

        $this->assertEquals('type_test', $response->name);
    }

    /**
     * @test
     *
     * @return void
     */
    public function updateTypeTest(): void
    {
        $type = $this->post('/api/type', [
            'name' => 'type_test',
        ])->assertStatus(200);

        $type = json_decode($type->getContent());

        $response = $this->put("/api/type/$type->id", [
            'name' => 'type_test_2'
        ])->assertStatus(200);
        $response = json_decode($response->getContent());

        $this->assertEquals('type_test_2', $response->name);
    }
}
