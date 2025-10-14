<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kode',
    ];

    // 🔹 Relasi ke karyawan (1 departemen punya banyak karyawan)
    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }

    // 🔹 Relasi ke user (kalau user langsung punya department_id)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
