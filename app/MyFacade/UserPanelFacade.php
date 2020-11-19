<?php

namespace App\MyFacade;
use Illuminate\Support\Facades\Facade;

class UserPanelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userpanel';
    }
}