<?php

use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedUrlsChecker as Checker;
use Kebir\MenuGenerator\MenuItem;

class LinkedUrlsCheckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_if_the_current_url_is_linked_to_a_menu_url()
    {
        $menu  = new MenuItem('menu1', '/users');

        $checker = new Checker('/users/edit', array('/users/edit' => '/users'));
        $this->assertTrue($checker->isLinked($menu));

        $checker = new Checker('/users/edit', array('/groups/edit' => '/groups'));
        $this->assertFalse($checker->isLinked($menu));
    }
}
