<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website\Gallery;

use App\Models\Base\BaseModel;

class Photo extends BaseModel
{
    protected $guarded = ['id'];

    protected $appends = ['thumb'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getImagesAttribute($value)
    {
        return ! empty($value) ? json_decode($value, true) : '';
    }

    public function getThumbAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            $image = $this->images['resize0'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }
}
