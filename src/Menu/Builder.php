<?php

namespace Kebir\Menu;

use Kebir\Menu\Repository\MenuRepository;

class Builder
{
    private $processed_menus = [];

    public function build($menus)
    {
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

                $item = new MenuItem($menu['name'], $menu['url']);

                foreach ($children as $child) {
                    $item->add($child);
                }

                $menus[] = $item;

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
