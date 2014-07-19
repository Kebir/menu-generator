<?php

namespace Kebir\MenuGenerator\Selector;

use Kebir\MenuGenerator\MenuItem;

class SimpleUrlSelector implements Selector
{
    /**
     * The current url path.
     *
     * @var string
     */
    protected $current_path;

    public function __construct($current_url)
    {
        $this->current_path = parse_url($current_url, PHP_URL_PATH) ?: '/';
    }

    /**
     * Checks if a menu is selected.
     *
     * @param  MenuItem $menu The menu item.
     *
     * @return boolean
     */
    public function isSelected(MenuItem $menu)
    {
        $selected = $this->current_path === $menu->getUrl();

        return $selected;
    }
}
