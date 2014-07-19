<?php

use Kebir\MenuGenerator\Builder;
use Kebir\MenuGenerator\MenuItem;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_builds_a_list_of_menu()
    {
        $menus = array(
            array("id" => 1, "name" => "Menu 1", "url" => "url1", "parent_id" => 3),
            array("id" => 2, "name" => "Menu 2", "url" => "url2", "parent_id" => 0),
            array("id" => 3, "name" => "Menu 3", "url" => "url3", "parent_id" => 0),
            array("id" => 4, "name" => "Menu 4", "url" => "url4", "parent_id" => 2),
            array("id" => 5, "name" => "Menu 5", "url" => "url5", "parent_id" => 3),
            array("id" => 6, "name" => "Menu 6", "url" => "url6", "parent_id" => 1),
        );
        $builder = new Builder();
        $menu_built = $builder->build($menus);

        //Expected menus.
        $menu1 = new MenuItem('Menu 1', 'url1');
        $menu2 = new MenuItem('Menu 2', 'url2');
        $menu3 = new MenuItem('Menu 3', 'url3');
        $menu4 = new MenuItem('Menu 4', 'url4');
        $menu5 = new MenuItem('Menu 5', 'url5');
        $menu6 = new MenuItem('Menu 6', 'url6');

        $menu2->add($menu4);

        $menu1->add($menu6);

        $menu3->add($menu1);
        $menu3->add($menu5);


        $this->assertEquals(array($menu2, $menu3), $menu_built);
    }
}
