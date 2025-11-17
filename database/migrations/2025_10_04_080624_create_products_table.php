<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique(); // kode unik
            $table->string('name');                // nama barang
            $table->string('category')->nullable(); // kategori barang
            $table->integer('qty')->default(0);     // jumlah stok
            $table->integer('min_stock')->default(0); // stok minimum
            $table->string('loc')->nullable();       // lokasi penyimpanan
            $table->string('uom')->nullable();       // satuan
            $table->foreignId('department_id')->nullable()
                ->constrained('departments')
                ->onDelete('set null');             // relasi ke departemen
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
