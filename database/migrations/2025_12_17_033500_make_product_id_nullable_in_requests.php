<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('product_requests', 'product_id')) {
            Schema::table('product_requests', function (Blueprint $table) {
                $table->foreignId('product_id')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // No down action needed as we are just loosening a constraint
    }
};
