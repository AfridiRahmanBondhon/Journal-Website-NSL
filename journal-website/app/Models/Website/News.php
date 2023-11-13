<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website;

use App\Models\Base\BaseModel;
use App\Models\Category;
use Illuminate\Support\Str;

class News extends BaseModel
{
    protected $guarded = ['id'];

    protected $appends = ['original_image', 'thumb_one'];

    protected $casts = [
        'created_at' => 'datetime:d M Y H:i A',
        'updated_at' => 'datetime:d M Y  H:i A',
    ];

    public function setDateAttribute($value)
    {
        if (! empty($value)) {
            $dateArray = explode(' ', $value);
            $day = $dateArray[0];
            $month = date_parse($value);
            $year = $dateArray[2];
            $date = $year.'-'.$month['month'].'-'.$day;
            $this->attributes['date'] = $date;
        }
    }

    public function getDateAttribute($value)
    {
        if (@! empty($value)) {
            return date('d M, Y', strtotime($value));
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = News::createSlug($url->title);
        });
    }

    private static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = News::where(['slug' => $slug])->count();
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
            $image = $image['200x200'] ?? null;

            return ! empty($image) ? url('/').'/public/storage/'.$image : null;
        }
    }

    public function getPdfFileAttribute($value)
    {
        if (! empty($value)) {
            return url('/').'/public/storage/'.$value;
        }

        return null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
