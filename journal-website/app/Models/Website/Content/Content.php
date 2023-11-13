<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website\Content;

use App\Models\Base\BaseModel;

class Content extends BaseModel
{
    protected $guarded = ['id'];

    protected $logName = 'Content';

    protected $appends = ['original_image', 'thumb_one'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function contentFiles()
    {
        return $this->hasMany(ContentFile::class)->oldest('sorting');
    }

    public function setImageAttribute($value)
    {
        if (! is_string($value)) {
            $this->attributes['image'] = json_encode($value);
        } else {
            $this->attributes['image'] = $value;
        }
    }

    public function getOriginalImageAttribute()
    {
        $image = json_decode($this->image, true);

        if ($image) {

            $image = $image['original'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function getThumbOneAttribute()
    {
        $image = json_decode($this->image, true);
        if ($image) {
            $image = $image['200x200'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function setIsMetaAttribute($value)
    {
        $this->attributes['is_meta'] = $value == true ? 1 : 0;
    }

    public function getIsMetaAttribute($value)
    {
        return $value == 1 ? true : false;
    }

    public function setMetaTagAttribute($value)
    {
        $this->attributes['meta_tag'] = json_encode($value);
    }

    public function getMetaTagAttribute($value)
    {
        $tag = json_decode($value);

        return explode(',', $tag);
    }
}
