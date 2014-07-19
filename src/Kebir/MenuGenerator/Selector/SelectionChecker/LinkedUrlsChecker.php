<?php

namespace Kebir\MenuGenerator\Selector\SelectionChecker;

use Kebir\MenuGenerator\MenuItem;

class LinkedUrlsChecker
{
    protected $linked_urls;

    protected $current_path;

    public function __construct($current_url, $linked_urls)
    {
        $this->current_path = parse_url($current_url, PHP_URL_PATH) ?: '/';
        $this->linked_urls = $linked_urls;
    }

    public function isLinked(MenuItem $menu)
    {
        $selected = false;
        foreach ($this->linked_urls as $url => $menu_url) {
            if ($this->current_path == $url && $menu_url === $menu->getUrl()) {
                $selected = true;
                break;
            }
        }
        return $selected;
    }
}
