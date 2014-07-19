<?php

use Kebir\MenuGenerator\MenuItem;

class MenuItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_returns_the_right_menu_attributes()
    {
        $menu  = new MenuItem('menu1', 'http://test.com');
        $this->assertEquals('menu1', $menu->getName());
        $this->assertEquals('http://test.com', $menu->getUrl());
    }

    public function it_returns_a_list_of_sub_menus()
    {
        $menu = new MenuItem('menu', 'url');
        $sub_menu1 = new MenuItem('menu1', 'url');
        $sub_menu2 = new MenuItem('menu2', 'url');

        $this->assertEmpty($menu->getElements());

        $menu->add($sub_menu1);
        $menu->add($sub_menu2);

        $this->assertEquals(array($sub_menu1, $sub_menu2), $menu->getElements());
    }
}
