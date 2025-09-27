<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddtoCart extends Model
{
    protected $table = 'customer_addto_carts';

    protected $fillable = [
        'customer_id',
        'item_id',
        'quantity',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
