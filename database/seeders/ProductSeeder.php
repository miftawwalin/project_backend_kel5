<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate(); // biar tidak duplikat saat seed ulang

        Product::create([
            'item_code' => 'BRG001',
            'name' => 'Baut Baja M10',
            'category' => 'Sparepart',
            'loc' => 'Rak A1',
            'qty' => 100,
            'uom' => 'pcs',
            'min_stock' => 20,
        ]);

        Product::create([
            'item_code' => 'BRG002',
            'name' => 'Kabel NYA 2.5mm',
            'category' => 'Elektrikal',
            'loc' => 'Rak B2',
            'qty' => 50,
            'uom' => 'meter',
            'min_stock' => 10,
        ]);

        Product::create([
            'item_code' => 'BRG003',
            'name' => 'Plat Besi 3mm',
            'category' => 'Material',
            'loc' => 'Rak C1',
            'qty' => 200,
            'uom' => 'lembar',
            'min_stock' => 30,
        ]);
    }
}
