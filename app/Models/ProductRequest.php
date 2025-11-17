<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    use HasFactory;

    protected $table = 'product_requests'; // contoh: 'request_barangs'

    protected $fillable = [
        'user_id', 'department_id', 'product_id',
        'quantity', 'note', 'status', 'approved_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function department() { return $this->belongsTo(Department::class); }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
