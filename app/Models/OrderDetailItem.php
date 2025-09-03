<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailItem extends Model
{
    protected $fillable = ['order_detail_id', 'item_id', 'quantity', 'price'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'order_detail_items';

    

}
