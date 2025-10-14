<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users & departments
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');

            // Data utama
            $table->string('npk')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); // L = Laki-laki, P = Perempuan
            $table->string('jabatan')->nullable();
            $table->enum('status_karyawan', ['Tetap', 'Kontrak', 'Magang'])->default('Tetap');
            $table->date('tanggal_masuk')->nullable();

            // Kontak
            $table->string('no_hp', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();

            // Tambahan (opsional)
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
