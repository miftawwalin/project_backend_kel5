<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'item_code')) {
                $table->string('item_code', 100)->unique()->after('id');
            }

            if (!Schema::hasColumn('products', 'name')) {
                $table->string('name', 255)->after('item_code');
            }

            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category', 100)->after('name');
            }

            if (!Schema::hasColumn('products', 'qty')) {
                $table->integer('qty')->default(0)->after('category');
            }

            if (!Schema::hasColumn('products', 'loc')) {
                $table->string('loc', 100)->nullable()->after('qty');
            }

            if (!Schema::hasColumn('products', 'uom')) {
                $table->string('uom', 10)->nullable()->after('loc');
            }

            if (!Schema::hasColumn('products', 'min_stock')) {
                $table->integer('min_stock')->nullable()->after('uom');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['item_code', 'name', 'category', 'qty', 'loc', 'uom', 'min_stock']);
        });
    }
};
