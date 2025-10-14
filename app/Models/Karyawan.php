<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'npk',
        'nama_lengkap',
        'jenis_kelamin',
        'jabatan',
        'status_karyawan',
        'tanggal_masuk',
        'no_hp',
        'email',
        'alamat',
        'foto',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
