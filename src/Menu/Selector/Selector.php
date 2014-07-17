<?php

namespace Kebir\Menu\Selector;

use Kebir\Menu\MenuItem;

interface Selector
{
    /**
     * Checks if a menu is selected.
     *
     * @param  MenuItem $menu The menu item.
     *
     * @return boolean
     */
    public function isSelected(MenuItem $menu);
}
