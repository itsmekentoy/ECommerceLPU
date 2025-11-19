<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $fillable = ['type_name'];

    protected $table = 'item_types';

    // One ItemType has many Items
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
