<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models\Website\Content;

use App\Models\Base\BaseModel;

class ContentFile extends BaseModel
{
    protected $guarded = ['id'];


    public function getFileAttribute($value)
    {

            return ! empty($value) ? url('/').'/public/storage/'.$value : null;
        
    }
}
