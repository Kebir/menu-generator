<?php

namespace Kebir\Menu;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->singleton('Kebir\Menu\Repository\MenuRepository', function () {
            return new Repository\EloquentMenuRepository(new Eloquent\Menu);
        });
    }
}
