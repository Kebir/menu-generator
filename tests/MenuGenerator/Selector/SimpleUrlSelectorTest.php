<?php

use Kebir\MenuGenerator\Selector\SimpleUrlSelector;
use Kebir\MenuGenerator\MenuItem;

class SimpleUrlSelectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_if_a_menu_url_is_the_same_as_the_current_path()
    {
        $menu  = new MenuItem('menu1', '/path');
        $selector1 = new SimpleUrlSelector('http://test.com/path');
        $selector2 = new SimpleUrlSelector('http://test.com/path2');

        $this->assertTrue($selector1->isSelected($menu));
        $this->assertFalse($selector2->isSelected($menu));
    }
}
