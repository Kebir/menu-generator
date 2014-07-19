<?php

namespace Kebir\MenuGenerator\Selector\SelectionChecker;

use Kebir\MenuGenerator\MenuItem;

class LinkedActionsChecker
{
    protected $linked_actions;

    protected $current_action;

    public function __construct($current_action, $linked_actions)
    {
        $this->current_action = $current_action;
        $this->linked_actions = $linked_actions;
    }

    public function isLinked(MenuItem $menu)
    {
        $selected = false;
        foreach ($this->linked_actions as $action => $menu_url) {
            if ($this->current_action == $action && $menu_url === $menu->getUrl()) {
                $selected = true;
                break;
            }
        }
        return $selected;
    }
}
