<?php

namespace Kebir\Menu\Renderer;

use Kebir\Menu\MenuItem;

interface MenuRenderer
{
    public function render(MenuItem $item);
}
