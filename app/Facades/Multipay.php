<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Multipay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'multipay';
    }
}
