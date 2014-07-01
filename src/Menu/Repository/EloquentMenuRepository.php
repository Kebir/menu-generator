<?php

namespace Kebir\Menu\Repository;

use Kebir\Menu\Eloquent\Menu;

class EloquentMenuRepository implements MenuRepository
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function getAll()
    {
        return $this->menu->get();
    }
}