<?php

namespace Myhayo\Branch\Facades;

use \Illuminate\Support\Facades\Facade;

class Branch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'walle';
    }
}