<?php

namespace Kebir\MenuGenerator;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Kebir\MenuGenerator\Selector\LaravelSelector;
use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedUrlsChecker;
use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedRoutesChecker;
use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedActionsChecker;
use Illuminate\Container\Container as App;

class MenuGeneratorServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
    }

    public function register()
    {
        $this->registerCheckers();

        $this->registerSelector();

        $this->registerRenderer();
    }

    protected function registerSelector()
    {
        $this->app->bind('Kebir\MenuGenerator\Selector\Selector', function (App $app) {
            $current_url = $app['request']->url();
            $linked_urls_checker = $app->make('linked_urls_checker');
            $linked_actions_checker = $app->make('linked_actions_checker');
            $linked_routes_checker = $app->make('linked_routes_checker');

            return new LaravelSelector(
                $current_url,
                $linked_urls_checker,
                $linked_actions_checker,
                $linked_routes_checker
            );
        });
    }

    protected function registerCheckers()
    {
        $this->app->bind('linked_urls_checker', function (App $app) {
            $current_url = $app['request']->url();
            $linked_urls = $app['config']->get('menu-generator::linked_urls', array());

            return new LinkedUrlsChecker($current_url, $linked_urls);
        });

        $this->app->bind('linked_actions_checker', function (App $app) {
            $current_route_action = $app['router']->currentRouteAction();
            $linked_actions = $app['config']->get('menu-generator::linked_actions', array());

            return new LinkedActionsChecker($current_route_action, $linked_actions);
        });

        $this->app->bind('linked_routes_checker', function (App $app) {
            $current_route = $app['router']->currentRouteName();
            $linked_routes = $app['config']->get('menu-generator::linked_routes', array());

            return new LinkedRoutesChecker($current_route, $linked_routes);
        });
    }

    public function registerRenderer()
    {
        $this->app->singleton('menu_renderer', function (App $app) {
            return new Renderer\HtmlListRenderer($app->make('Kebir\MenuGenerator\Selector\Selector'));
        });
    }

    public function provides()
    {
        return array('menu_renderer', 'Kebir\MenuGenerator\Selector\Selector');
    }
}
