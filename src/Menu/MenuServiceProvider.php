<?php

namespace Kebir\Menu;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class MenuServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->bindShared('menu_renderer', function () {
            return new Renderer\HtmlListRenderer();
        });
    }
}
