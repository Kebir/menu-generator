<?php

namespace Kebir\MenuGenerator;

class Builder
{
    /**
     * @var array
     */
    private $processed_menus = array();

    /**
     * Builds a list of MenuItem object given an array of menus informations.
     * Each menus in the provided list, should have the following index:
     *  - id: The id of the menu.
     *  - name: The name of the menu.
     *  - url: The url of the menu.
     *  - parent_id: The id of the parent element of this menu (Menu without parents should have 0).
     *
     * @param  array $menus The array of menus informations.
     *
     * @return array
     */
    public function build($menus)
    {
        $menus_built = $this->buildFromList($menus);

        $this->clearProcessedMenus();

        return $menus_built;
    }

    /**
     * Build the menus.
     *
     * @param  array   $menus_list The list of menu informations
     * @param  integer $parent     The parent id to build.
     *
     * @return array
     */
    protected function buildFromList($menus_list, $parent = 0)
    {
        $menus = array();
        foreach ($menus_list as $menu) {
            //Process only if the menu was not already processed
            //and it belongs to the parent id we are building.
            if (!$this->isProcessed($menu) && $menu['parent_id'] == $parent) {
                //First get the submenus
                $children = $this->buildFromList($menus_list, $menu['id']);

                $item = new MenuItem($menu['name'], $menu['url']);
                foreach ($children as $child) {
                    $item->add($child);
                }

                $menus[] = $item;

                //Update the status of the current item.
                $this->setProcessed($menu);
            }
        }
        return $menus;
    }

    /**
     * Check if the menu is already processed.
     *
     * @param  array $menu The menu informations.
     *
     * @return boolean
     */
    private function isProcessed($menu)
    {
        return isset($this->processed_menus[$menu['id']]);
    }

    /**
     * Set the menu as "processed".
     *
     * @param array $menu The menu informations.
     */
    private function setProcessed($menu)
    {
        $this->processed_menus[$menu['id']] = true;
    }

    /**
     * Remove all status of the menus to "unprocessed".
     * (Used only after building the menus).
     */
    private function clearProcessedMenus()
    {
        $this->processed_menus = array();
    }
}
