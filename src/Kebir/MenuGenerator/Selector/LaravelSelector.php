<?php

namespace Kebir\MenuGenerator\Selector;

use Kebir\MenuGenerator\MenuItem;

class LaravelSelector extends SimpleUrlSelector
{
    protected $linked_urls_checker;

    protected $linked_actions_checker;

    protected $linked_routes_checker;

    public function __construct($current_url, $linked_urls_checker, $linked_actions_checker, $linked_routes_checker)
    {
        parent::__construct($current_url);

        $this->linked_urls_checker = $linked_urls_checker;
        $this->linked_actions_checker = $linked_actions_checker;
        $this->linked_routes_checker = $linked_routes_checker;
    }

    public function isSelected(MenuItem $menu)
    {
        $selected = parent::isSelected($menu);

        if (!$selected) {
            $checkers = array($this->linked_urls_checker, $this->linked_actions_checker, $this->linked_routes_checker);
            foreach ($checkers as $checker) {
                if ($checker) {
                    if ($selected = $checker->isLinked($menu)) {
                        break;
                    }
                }
            }
        }

        return $selected;
    }
}
