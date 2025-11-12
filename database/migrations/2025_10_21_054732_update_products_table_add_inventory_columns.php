<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Pastikan kolom utama lama tidak dihapus dulu, biar CRUD lama tetap aman
            if (!Schema::hasColumn('products', 'item_code')) {
                $table->string('item_code')->nullable()->after('id');
            }

            if (!Schema::hasColumn('products', 'description')) {
                $table->string('description')->nullable()->after('item_code');
            }

            if (!Schema::hasColumn('products', 'user')) {
                $table->string('user')->nullable()->after('description');
            }

            if (!Schema::hasColumn('products', 'loc')) {
                $table->string('loc')->nullable()->after('user');
            }

            if (!Schema::hasColumn('products', 'total_gr_september')) {
                $table->integer('total_gr_september')->default(0)->after('loc');
            }

            if (!Schema::hasColumn('products', 'gi_september')) {
                $table->integer('gi_september')->default(0)->after('total_gr_september');
            }

            if (!Schema::hasColumn('products', 'ending_balance_september')) {
                $table->integer('ending_balance_september')->default(0)->after('gi_september');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'item_code',
                'description',
                'user',
                'loc',
                'total_gr_september',
                'gi_september',
                'ending_balance_september',
            ]);
        });
    }
};
