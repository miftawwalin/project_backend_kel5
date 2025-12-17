<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'item_code',
        'name',
        'description',
        'category',
        'qty',
        'stock',
        'min_stock',
        'stock_max',
        'titik_order',
        'uom',
        'loc',
        'department_id',
        'total_gr_september',
        'gi_september',
        'ending_balance_september',
    ];

    public function requests()
    {
        return $this->hasMany(ProductRequest::class, 'product_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
