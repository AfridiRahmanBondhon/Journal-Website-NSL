<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Country extends BaseModel
{
    protected $guarded = ['id'];

    protected $logName = 'Country';

    public function getNameAttribute($value)
    {
        return $value.' +'.$this->phonecode;
    }
}
