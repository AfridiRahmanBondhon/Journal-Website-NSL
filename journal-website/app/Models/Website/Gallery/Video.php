<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website\Gallery;

use App\Models\Base\BaseModel;

class Video extends BaseModel
{
    protected $guarded = ['id'];

    protected $appends = ['original_image', 'thumb_one'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function setThumbnailAttribute($value)
    {
        if (! is_string($value)) {
            $this->attributes['thumbnail'] = json_encode($value);
        } else {
            $this->attributes['thumbnail'] = $value;
        }
    }

    public function getOriginalImageAttribute()
    {
        $image = json_decode($this->thumbnail, true);

        if ($image) {

            $image = $image['original'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function getThumbOneAttribute()
    {
        $image = json_decode($this->thumbnail, true);
        if ($image) {
            $image = $image['200x200'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }
}
