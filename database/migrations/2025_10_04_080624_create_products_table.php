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
            $table->string('item_code', 100)->unique();
            $table->string('name', 255);
            $table->string('category', 100);
            $table->integer('stock')->default(0);
            $table->integer('qty')->default(0);
            $table->string('loc', 100)->nullable();
            $table->string('uom', 10)->nullable();
            $table->integer('min_stock')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
