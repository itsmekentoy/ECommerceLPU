<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_type_id',
        'item_name',
        'description',
        'stock',
        'price',
        'file_path'
    ];

    // Each Item belongs to one ItemType
    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }
}
