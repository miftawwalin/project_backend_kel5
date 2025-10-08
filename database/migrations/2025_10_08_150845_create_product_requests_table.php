<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();

            // Relasi ke users & departments
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');

            // Relasi ke produk
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // Detail permintaan
            $table->integer('quantity');
            $table->string('note')->nullable();

            // Status dan approval
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_requests');
    }
};
