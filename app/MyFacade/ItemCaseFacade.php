<?php

namespace App\MyFacade;
use Illuminate\Support\Facades\Facade;

class ItemCaseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'itemcase';
    }
}