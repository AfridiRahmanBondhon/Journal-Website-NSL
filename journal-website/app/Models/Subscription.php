<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Subscription extends BaseModel
{
    protected $guarded = ['id'];
    
    protected $logName = "Subscription";

    public $fillable = [
        'email',
        'name',
    ];

    // file image push

    // date format
}
