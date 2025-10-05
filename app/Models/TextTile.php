<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextTile extends Model
{
    protected $fillable = ['title', 'file_path', 'price'];

    public function appliedTo()
    {
        return $this->hasMany(TextTileAppliedto::class, 'texttile_id');
    }

}
