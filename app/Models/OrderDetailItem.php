<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailItem extends Model
{
    protected $fillable = ['order_detail_id', 'item_id', 'quantity', 'price','customization_textile_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $table = 'order_detail_items';

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetails::class, 'order_detail_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function textile()
    {
        return $this->belongsTo(TextTile::class, 'customization_textile_id');
    }
}
