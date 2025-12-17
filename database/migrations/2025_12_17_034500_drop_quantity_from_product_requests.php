<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('product_requests', 'quantity')) {
            Schema::table('product_requests', function (Blueprint $table) {
                // We drop the column because the header table shouldn't have quantity
                // Items are stored in product_request_items
                $table->dropColumn('quantity');
            });
        }
    }

    public function down(): void
    {
        Schema::table('product_requests', function (Blueprint $table) {
            $table->integer('quantity')->default(0);
        });
    }
};
