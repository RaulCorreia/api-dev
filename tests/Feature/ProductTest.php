<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     *
     * @return void
     */
    public function getAllProductTest(): void
    {
        $this->get('/api/product')->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Sabão em pó',
                'name' => 'Sabão liquido',
                'name' => 'Arroz',
                'name' => 'Produto de limpeza',
                'name' => 'Alimentação',
            ]);
    }


    /**
     * @test
     *
     * @return void
     */
    public function createProductTest(): void
    {
        $response = $this->post('/api/product', [
            'name' => 'test',
            'quantity' => 0,
            'type' => 1
        ])->assertStatus(200);

        $response = json_decode($response->getContent());

        $this->assertEquals('test', $response->name);
        $this->assertEquals(0, $response->quantity);
        $this->assertEquals(1, $response->type_id);
    }


    /**
     * @test
     *
     * @return void
     */
    public function updateProductTest(): void
    {
        $product = $this->get('/api/product/1')->assertStatus(200);
        $product = json_decode($product->getContent());

        $response = $this->put('/api/product/1', [])->assertStatus(200);
        $response = json_decode($response->getContent());

        $this->assertEquals($product->quantity + 1, $response->quantity);
        $this->assertEquals(1, $response->id);
    }

    /**
     * @test
     *
     * @return void
     */
    public function deleteProductTest(): void
    {
        $product = $this->post('/api/product', [
            'name' => 'test',
            'quantity' => 0,
            'type' => 1
        ])->assertStatus(200);
        $product = json_decode($product->getContent());

        $response = $this->delete("/api/product/$product->id")->assertStatus(200);
        $response = json_decode($response->getContent());

        $this->assertEquals('Product deleted with success', $response->messsage);
    }

    /**
     * @test
     * @dataProvider validateFieldsProvider
     * @return void
     */
    public function validateCreateProductTest($params, $validation): void
    {
        $this->post('/api/product', $params)
            ->assertStatus(302)
            ->assertSessionHasErrors($validation);

    }


    // Dataprovider
    public function validateFieldsProvider()
    {
        return [
            [
                'params' => [
                    'name' => 'test',
                    'quantity' => 0,
                ],
                'validation' => [
                    'type' => 'The type field is required.'
                ]
            ],
            [
                'params' => [
                    'quantity' => 0,
                    'type' => 1
                ],
                'validation' => [
                    'name' => 'The name field is required.'
                ]
            ],
            [
                'params' => [
                    'name' => 'test',
                    'type' => 1,
                    'quantity' => 'text'
                ],
                'validation' => [
                    'quantity' => 'The quantity must be an integer.'
                ]
            ],
        ];
    }
}
