<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_request_id',
        'product_id',
        'qty',
        'validated',
        'npk'
    ];

    public function request()
    {
        return $this->belongsTo(ProductRequest::class, 'product_request_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
