<?php

use Kebir\MenuGenerator\Selector\SelectionChecker\LinkedActionsChecker as Checker;
use Kebir\MenuGenerator\MenuItem;

class LinkedActionsCheckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_checks_if_the_current_action_is_linked_to_a_menu_url()
    {
        $menu  = new MenuItem('menu1', '/path');

        $checker = new Checker('DummyController@edit', array('DummyController@edit' => '/path'));
        $this->assertTrue($checker->isLinked($menu));

        $checker = new Checker('DummyController@edit', array('OtherController@edit' => '/path'));
        $this->assertFalse($checker->isLinked($menu));
    }
}
