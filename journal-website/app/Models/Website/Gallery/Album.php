<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website\Gallery;

use App\Models\Base\BaseModel;
use Illuminate\Support\Str;

class Album extends BaseModel
{
    protected $guarded = ['id'];

    protected $appends = ['original_image', 'thumb_one', 'thumb_two'];

    const PHOTOS = 'Photos';

    const VIDEOS = 'Videos';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d M Y H:i A',
        'updated_at' => 'datetime:d M Y  H:i A',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = Album::createSlug($url->name);
        });
    }

    public static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Album::where(['slug' => $slug])->count();
        if ($count > 0) {
            $slug = $slug.$count;
        }

        return $slug;
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
            $image = $image['242x242'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function getThumbTwoAttribute()
    {
        $image = json_decode($this->image, true);
        if ($image) {
            $image = $image['339x260'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'album_id', 'id');
    }
}
