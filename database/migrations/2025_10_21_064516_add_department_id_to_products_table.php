<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom relasi ke tabel departments
            if (!Schema::hasColumn('products', 'department_id')) {
                $table->unsignedBigInteger('department_id')->nullable()->after('uom');

                // Foreign key untuk menjaga integritas data
                $table->foreign('department_id')
                      ->references('id')
                      ->on('departments')
                      ->onDelete('set null');
            }
        });
    }

    public function down(): void {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'department_id')) {
                $table->dropForeign(['department_id']);
                $table->dropColumn('department_id');
            }
        });
    }
};
