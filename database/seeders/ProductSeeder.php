<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 🚫 Matikan foreign key check sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Gunakan delete() bukan truncate()
        Product::query()->delete();

        // ✅ Masukkan contoh data produk
        Product::create([
            'item_code' => 'P001',
            'name' => 'Kabel Listrik',
            'category' => 'Elektrikal',
            'stock' => 10,
            'qty' => 10,
            'loc' => 'Rak A1',
            'uom' => 'pcs',
            'min_stock' => 2,
        ]);

        Product::create([
            'item_code' => 'P002',
            'name' => 'Baut Besi',
            'category' => 'Material',
            'stock' => 25,
            'qty' => 25,
            'loc' => 'Rak B2',
            'uom' => 'pcs',
            'min_stock' => 5,
        ]);

        // ✅ Aktifkan kembali foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
