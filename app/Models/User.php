<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',            // admin atau user
        'department_id',
        'npk'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke model Karyawan
     * 1 user hanya punya 1 data karyawan
     */
    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    /**
     * Relasi ke model Department (jika langsung ada department_id di tabel users)
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relasi ke permintaan barang
     */
    public function requests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    /**
     * Cek role user
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
