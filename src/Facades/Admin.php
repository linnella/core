<?php

namespace Core\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Core\Admin\Admin::class;
    }
}
