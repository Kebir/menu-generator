<?php

namespace Kebir\Menu\Renderer;

use Kebir\Menu\MenuItem;
use Kebir\Menu\Selector\Selector;

class HtmlListRenderer implements MenuRenderer
{
    /**
     * @var Kebir\Menu\Selector\Selector
     */
    protected $selector;

    /**
     * @param Kebir\Menu\Selector\Selector $selector The menu selector.
     */
    public function __construct(Selector $selector)
    {
        $this->selector = $selector;
    }

    /**
     * Render a MenuItem class.
     *
     * @param  MenuItem $menu
     *
     * @return string
     */
    public function render(MenuItem $menu)
    {
        return $this->renderMenu($menu);
    }

    /**
     * Render a menu for a specific level.
     *
     * @param  MenuItem $menu
     * @param  integer  $level
     *
     * @return string
     */
    protected function renderMenu(MenuItem $menu, $level = 1)
    {
        //Render the submenus first.
        $children = '';
        if ($menu->getElements()) {
            $children .= '<ul class="kebir-sub-menu">';
            foreach ($menu->getElements() as $sub_menu) {
                $children .= $this->renderMenu($sub_menu, $level + 1);
            }
            $children .= "</ul>";
        }

        //Prepare the html classes to add to the menu.
        $selected = $this->isSelectedMenu($menu, $children) ? ' selected' : '';
        $has_children = $children ? ' has-sub-menu' : '';

        //Get the final output.
        $output = '<li class="kebir-menu level-' . $level . $selected . $has_children . '">';
        $output .= "<a href=".$menu->getUrl().' class="kebir-menu-label">'.$menu->getName()."</a>";
        $output .= $children;
        $output .= "</li>";

        return $output;
    }

    /**
     * Check if a menu is selected.
     *
     * @param  MenuItem $menu
     * @param  string   $children_output
     *
     * @return boolean
     */
    protected function isSelectedMenu(MenuItem $menu, $children_output)
    {
        return strpos($children_output, 'selected') !== false || $this->selector->isSelected($menu);
    }
}
