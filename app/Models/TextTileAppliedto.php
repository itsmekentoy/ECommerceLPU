<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextTileAppliedto extends Model
{
    protected $fillable = ['texttile_id', 'category_id'];

    public function textTile()
    {
        return $this->belongsTo(TextTile::class, 'texttile_id');
    }

    public function category()
    {
        return $this->belongsTo(ItemType::class, 'category_id');
    }
    

}
