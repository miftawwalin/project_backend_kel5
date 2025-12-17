<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'status',
        'note',
        'request_date',
        'npk_nama',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // HEADER → MANY ITEMS
    public function items()
    {
        return $this->hasMany(ProductRequestItem::class);
    }
}
