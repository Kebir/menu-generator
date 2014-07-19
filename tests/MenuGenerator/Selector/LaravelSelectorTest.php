<?php

use Kebir\MenuGenerator\Selector\LaravelSelector;
use Kebir\MenuGenerator\MenuItem;
use Mockery as m;

class LaravelSelectorTest extends PHPUnit_Framework_TestCase
{
    protected $urls_checker;
    protected $actions_checker;
    protected $routes_checker;

    protected function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->urls_checker = m::mock('Kebir\MenuGenerator\Selector\SelectionChecker\LinkedUrlsChecker');
        $this->actions_checker = m::mock('Kebir\MenuGenerator\Selector\SelectionChecker\LinkedActionsChecker');
        $this->routes_checker = m::mock('Kebir\MenuGenerator\Selector\SelectionChecker\LinkedRoutesChecker');

        $this->selector = new LaravelSelector(
            'http://test.com/path',
            $this->urls_checker,
            $this->actions_checker,
            $this->routes_checker
        );
    }

    /**
     * @test
     */
    public function it_checks_if_a_menu_is_selected_if_there_is_a_linked_url()
    {
        $menu  = new MenuItem('menu1', '/other_path');
        $this->urls_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(true);

        $this->assertTrue($this->selector->isSelected($menu));
    }

    /**
     * @test
     */
    public function it_checks_if_a_menu_is_selected_if_there_is_a_linked_action()
    {
        $menu  = new MenuItem('menu1', '/other_path');
        $this->urls_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);
        $this->actions_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(true);

        $this->assertTrue($this->selector->isSelected($menu));
    }

    /**
     * @test
     */
    public function it_checks_if_a_menu_is_selected_if_there_is_a_linked_route()
    {
        $menu  = new MenuItem('menu1', '/other_path');
        $this->urls_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);
        $this->actions_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);
        $this->routes_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(true);

        $this->assertTrue($this->selector->isSelected($menu));
    }

    /**
     * @test
     */
    public function it_returns_false_when_no_linked_resource_was_found()
    {
        $menu  = new MenuItem('menu1', '/other_path');
        $this->urls_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);
        $this->actions_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);
        $this->routes_checker->shouldReceive('isLinked')->once()->with($menu)->andReturn(false);

        $this->assertFalse($this->selector->isSelected($menu));
    }
}
