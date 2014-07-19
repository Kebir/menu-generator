<?php

use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedRoutesChecker as Checker;
use Kebir\MenuGenerator\MenuItem;

class LinkedRoutesCheckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_if_the_current_route_is_linked_to_a_menu_url()
    {
        $menu  = new MenuItem('menu1', '/path');

        $checker = new Checker('user.edit', array('user.edit' => '/path'));
        $this->assertTrue($checker->isLinked($menu));

        $checker = new Checker('user.edit', array('group.edit' => '/path'));
        $this->assertFalse($checker->isLinked($menu));
    }
}
