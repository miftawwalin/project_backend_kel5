<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'item_code' => 'P001',
            'name' => 'Kabel Listrik',
            'category' => 'Elektrikal',
            'qty' => 10,
            'loc' => 'Rak A1',
            'uom' => 'pcs',
            'min_stock' => 2,
            'department_id' => 1, 
        ]);

        Product::create([
            'item_code' => 'P002',
            'name' => 'Sarung Tangan Safety',
            'category' => 'Consumable',
            'qty' => 20,
            'loc' => 'Rak B2',
            'uom' => 'pair',
            'min_stock' => 5,
            'department_id' => 3, 
        ]);
    }
}
