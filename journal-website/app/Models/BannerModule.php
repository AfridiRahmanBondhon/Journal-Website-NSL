<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class BannerModule extends BaseModel
{
    protected $guarded = ['id'];
    
    protected $logName = "BannerModule";

    public function getBannerImg1Attribute($value)
    {
        return ! empty($value)
            ? url('/').'/public/storage/'.$value
            : url('/').'/public/images/n-logo.png';
    }

    // file image push

    // date format
}
