<?php

namespace Kebir\MenuGenerator\Selector;

use Kebir\MenuGenerator\MenuItem;

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
