<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models;

use App\Models\Base\ParentModel;
use Illuminate\Support\Str;

class Events extends ParentModel
{
    protected $guarded = ['id'];

    protected $logName = 'Events';

    protected $appends = ['original_image', 'thumb_one'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = Events::createSlug($url->title);
        });
    }

    private static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Events::where(['slug' => $slug])->count();
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

    public function setStartDateAttribute($value)
    {
        $dateArray = explode(' ', $value);
        $day = $dateArray[0];
        $month = date_parse($value);
        $year = $dateArray[2];
        $date = $year.'-'.$month['month'].'-'.$day;
        $this->attributes['start_date'] = $date;
    }

    public function setEndDateAttribute($value)
    {
        $dateArray = explode(' ', $value);
        $day = $dateArray[0];
        $month = date_parse($value);
        $year = $dateArray[2];
        $date = $year.'-'.$month['month'].'-'.$day;
        $this->attributes['end_date'] = $date;
    }

    public function getStartDateAttribute($value)
    {
        return date('d M, Y', strtotime($value));
    }

    public function getEndDateAttribute($value)
    {
        return date('d M, Y', strtotime($value));
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

    public function eventSchedules()
    {
        return $this->hasMany(EventSchedule::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
