<?php

namespace Kebir\Menu;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class MenuServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('kebir/menu-generator', 'kebir/menu-generator');
    }

    public function register()
    {
        $this->app->bind('Kebir\Menu\Selector\Selector', function ($app) {
            return new Selector\SimpleUrlSelector($app['request']->url());
        });

        $this->app->bindShared('menu_renderer', function ($app) {
            return new Renderer\HtmlListRenderer($app->make('Kebir\Menu\Selector\Selector'));
        });
    }
}
