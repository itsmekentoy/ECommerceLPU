<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselItem extends Model
{
    protected $table = 'carousel_items';

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'storage_disk',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all active carousel items sorted by order
     */
    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * Get the full image URL based on storage disk
     */
    public function getImageUrlAttribute()
    {
        if ($this->storage_disk === 's3') {
            return \Storage::disk('s3')->url($this->image_path);
        } else {
            return asset('storage/' . $this->image_path);
        }
    }
}
