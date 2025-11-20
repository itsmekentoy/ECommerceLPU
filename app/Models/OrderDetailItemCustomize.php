<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailItemCustomize extends Model
{
    protected $fillable = ['order_detail_item_id', 'textile', 'size', 'type'];

    protected $table = 'order_detail_item_customizations';
}
