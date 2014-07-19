<?php

namespace Kebir\MenuGenerator\Selector\SelectionChecker;

use Kebir\MenuGenerator\MenuItem;

class LinkedRoutesChecker
{
    protected $linked_routes;

    protected $current_route;

    public function __construct($current_route, $linked_routes)
    {
        $this->current_route = $current_route;
        $this->linked_routes = $linked_routes;
    }

    public function isLinked(MenuItem $menu)
    {
        $selected = false;
        foreach ($this->linked_routes as $route => $menu_url) {
            if ($this->current_route == $route && $menu_url === $menu->getUrl()) {
                $selected = true;
                break;
            }
        }
        return $selected;
    }
}
