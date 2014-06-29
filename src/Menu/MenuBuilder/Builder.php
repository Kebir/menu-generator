<?php

namespace Kebir\Menu\MenuBuilder;

use Kebir\Menu\MenuItem;
use Kebir\Menu\MenuItemsList;
use Kebir\Menu\Repository\MenuRepository;

class Builder
{
    protected $menu_repository;

    private $processed_menus = [];

    public function __construct(MenuRepository $menu_repository)
    {
        $this->menu_repository = $menu_repository;
    }

    public function build()
    {
        $menus = $this->menu_repository->getAll();

        $menus_built = $this->buildFromList($menus);

        $this->clearProcessedMenus();

        return $menus_built;
    }

    protected function buildFromList($menus_list, $parent = 0)
    {
        $menus = [];
        foreach ($menus_list as $menu) {
            if (!$this->isProcessed($menu) && $menu['parent_id'] == $parent) {
                $children = $this->buildFromList($menus_list, $menu['id']);

                if ($children) {
                    $list = new MenuItemsList($menu['name'], $menu['url']);

                    foreach ($children as $child) {
                        $list->add($child);
                    }

                    $menus[] = $list;
                } else {
                    $menus[] = new MenuItem($menu['name'], $menu['url']);
                }
                $this->setProcessed($menu);
            }
        }
        return $menus;
    }

    private function isProcessed($menu)
    {
        return isset($this->processed_menus[$menu['id']]);
    }

    private function setProcessed($menu)
    {
        $this->processed_menus[$menu['id']] = true;
    }

    private function clearProcessedMenus()
    {
        $this->processed_menus = [];
    }
}
