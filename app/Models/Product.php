<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'item_code','name','category','loc','qty','uom','min_stock'
    ];

    public function requests()
    {
        return $this->hasMany(RequestProduct::class);
    }
}
