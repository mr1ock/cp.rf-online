<?php

namespace App\MyFacade;
use Illuminate\Support\Facades\Facade;

class SmartPanelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'smartpanel';
    }
}