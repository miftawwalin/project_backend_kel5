<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'karyawan_id', 'department_id',
        'qty', 'note', 'status'
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function karyawan() { return $this->belongsTo(Karyawan::class); }
    public function department() { return $this->belongsTo(Department::class); }
}

