<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['order_code', 'customer_id', 'status', 'total_amount', 'delivery_address', 'payment_file_path'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getPaymentFilePathAttribute($value)
    {
        //return the image with MYLINK from .env ./storage/payments/
        return $value ? env('MYLINK') . '/storage/payments/' . $value : null;
    }
    public function customer()
    {
        return $this->belongsTo(CustomerInformation::class, 'customer_id');
    }
    public function items()
    {
        return $this->hasMany(OrderDetailItem::class, 'order_detail_id');
    }
}
