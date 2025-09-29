<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Metal Bracket A1',
                'item_code' => 'MTA001',
                'category' => 'Brackets',
                'qty' => 150,
                'min_stock' => 20,
            ],
            [
                'name' => 'Steel Rod B2',
                'item_code' => 'STR002',
                'category' => 'Rods',
                'qty' => 15,
                'min_stock' => 25,
            ],
            [
                'name' => 'Aluminum Sheet C3',
                'item_code' => 'ALS003',
                'category' => 'Sheets',
                'qty' => 0,
                'min_stock' => 10,
            ],
            [
                'name' => 'Copper Wire D4',
                'item_code' => 'CPW004',
                'category' => 'Wires',
                'qty' => 200,
                'min_stock' => 50,
            ],
            [
                'name' => 'Iron Pipe E5',
                'item_code' => 'IRP005',
                'category' => 'Pipes',
                'qty' => 8,
                'min_stock' => 15,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
