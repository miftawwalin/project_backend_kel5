<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role',['admin','user'])->default('user');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('npk')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // relasi ke departments
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
