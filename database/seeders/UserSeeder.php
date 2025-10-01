<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@metalart.com',
            'password' => Hash::make('password123'), 
            'role' => 'admin',
            'npk' => 'ADM001',
        ]);

        // User
        User::create([
            'name' => 'Staff Produksi',
            'email' => 'user@metalart.com',
            'password' => Hash::make('password123'), // wajib pakai hash
            'role' => 'user',
            'npk' => 'USR001',
        ]);
    }
}
