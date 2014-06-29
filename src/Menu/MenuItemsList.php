<?php

namespace Kebir\Menu;

class MenuItemsList extends MenuItem
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Adds a new item to the menu.
     *
     * @return string.
     */
    public function add(MenuItem $element)
    {
        $this->items[] = $element;
    }

    /**
     * Returns the list of items.
     *
     * @return array
     */
    public function getElements()
    {
        return $this->items;
    }
}
