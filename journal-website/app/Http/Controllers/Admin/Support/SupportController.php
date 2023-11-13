<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\Country;

class SupportController extends Controller
{
    public function countries()
    {
        return Country::get();
    }
}
