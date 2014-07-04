<?php

namespace Kebir\Menu\Renderer;

use Kebir\Menu\MenuItem;

class HtmlListRenderer implements MenuRenderer
{
    protected $current_path;

    public function __construct($current_url)
    {
        $this->current_path = parse_url($current_url, PHP_URL_PATH) ?: '/';
    }

    public function render(MenuItem $menu)
    {
        return $this->renderMenu($menu);
    }

    protected function renderMenu(MenuItem $menu, $level = 1)
    {
        $children = '';
        if ($menu->getElements()) {
            $children .= '<ul class="kebir-sub-menu">';
            foreach ($menu->getElements() as $sub_menu) {
                $children .= $this->renderMenu($sub_menu, $level + 1);
            }
            $children .= "</ul>";
        }

        $selected = $this->isSelectedMenu($menu, $children) ? ' selected' : '';
        $has_children = $children ? ' has-sub-menu' : '';

        $output = '<li class="kebir-menu level-' . $level . $selected . $has_children . '">';
        $output .= "<a href=".$menu->getUrl().' class="kebir-menu-label">'.$menu->getName()."</a>";
        $output .= $children;
        $output .= "</li>";

        return $output;
    }

    protected function isSelectedMenu(MenuItem $menu, $children_output)
    {
        return $this->current_path === $menu->getUrl() || strpos($children_output, 'selected') !== false;
    }
}
