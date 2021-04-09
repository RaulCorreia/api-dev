<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cleaningType = Type::firstOrCreate([
            'name' => 'Produto de limpeza'
        ]);

        Product::firstOrCreate([
            'name' => 'Sabão em pó',
            'quantity' => 2,
            'type_id' => $cleaningType->id
        ]);

        Product::firstOrCreate([
            'name' => 'Sabão liquido',
            'quantity' => 5,
            'type_id' => $cleaningType->id
        ]);

        $foodType = Type::firstOrCreate([
            'name' => 'Alimentação'
        ]);

        Product::firstOrCreate([
            'name' => 'Arroz',
            'type_id' => $foodType->id
        ]);
    }
}
