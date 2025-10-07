<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['order_code', 'customer_id', 'status', 'total_amount', 'delivery_address'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerInformation::class, 'customer_id');
    }
    public function items()
    {
        return $this->hasMany(OrderDetailItem::class, 'order_detail_id');
    }
}
