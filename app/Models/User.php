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

    // relasi ke department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // cek role langsung
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function requests()
{
    return $this->hasMany(RequestProduct::class);
}
}
