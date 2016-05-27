<?php

namespace Kebir\MenuGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class Renderer extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menu.renderer';
    }
}
