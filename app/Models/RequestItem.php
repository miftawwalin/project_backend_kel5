<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestItem extends Model
{
    use HasFactory;

    protected $table = 'request_items';

    protected $fillable = [
        'request_id', 'item_code', 'item_name', 'loc', 'qty', 'uom', 'npk_name'
    ];

    public function request()
    {
        return $this->belongsTo(RequestModel::class, 'request_id');
    }
}
