<?php

namespace Kebir\Menu\Renderer;

use Kebir\Menu\MenuItem;

class HtmlListRenderer implements MenuRenderer
{
    public function render(MenuItem $menu)
    {
        return $this->renderMenu($menu);
    }

    protected function renderMenu(MenuItem $menu)
    {
        $output = "<li>";
        $output .= "<a href=".$menu->getUrl().">".$menu->getName()."</a>";
        if ($menu->getElements()) {
            $output .= "<ul>";
            foreach ($menu->getElements() as $sub_menu) {
                $output .= $this->renderMenu($sub_menu);
            }
            $output .= "</ul>";
        }
        return $output."</li>";
    }
}
