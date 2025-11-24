<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_request_items', function (Blueprint $table) {
            $table->id();

            // FK ke request utama (header)
            $table->foreignId('product_request_id')->constrained('product_requests')->onDelete('cascade');

            // FK ke product (item)
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // qty diminta user/admin
            $table->integer('qty');

            // npk karyawan yang input item ini
            $table->string('npk')->nullable();

            // Validasi barcode admin
            $table->boolean('validated')->default(false);
            $table->timestamp('validated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_request_items');
    }
};
