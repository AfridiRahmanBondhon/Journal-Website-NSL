<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Testimonial extends BaseModel
{
    protected $guarded = ['id'];
    
    protected $logName = "Testimonial";

    public function getImageAttribute($value)
    {
        return ! empty($value)
            ? url('/').'/public/storage/'.$value
            : url('/').'/public/images/n-logo.png';
    }

    // file image push

    // date format
}
