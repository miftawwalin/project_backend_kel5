<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'request_date', 'produk', 'request_by', 'status', 'notes'
    ];

    public function items()
    {
        return $this->hasMany(RequestItem::class, 'request_id');
    }
}
