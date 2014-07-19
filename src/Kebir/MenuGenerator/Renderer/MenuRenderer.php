<?php

namespace Kebir\MenuGenerator\Renderer;

use Kebir\MenuGenerator\MenuItem;

interface MenuRenderer
{
    public function render(MenuItem $item);
}
