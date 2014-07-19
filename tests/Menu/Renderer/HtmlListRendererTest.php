<?php

use Kebir\MenuGenerator\MenuItem;
use Kebir\MenuGenerator\Renderer\HtmlListRenderer;
use Kebir\MenuGenerator\Selector\SimpleUrlSelector;

class HtmlListRendererTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_render_a_menu_with_html_unordered_list()
    {
        //Prepare the menu.
        $menu = new MenuItem('Menu 1', '/url1');
        $sub_menu = new MenuItem('Menu 2', '/url2');
        $menu->add($sub_menu);

        $selector = new SimpleUrlSelector('http://test.com/url2');

        //Render the menu
        $renderer = new HtmlListRenderer($selector);
        $output = $renderer->render($menu);

        //Prepare the expectations.
        $matcher1 = array(
            'tag' => 'li',
            'attributes' => array('class' => 'kebir-menu level-1 selected has-sub-menu'),
            'child' => array(
                'tag' => 'ul',
                'attributes' => array('class' => 'kebir-sub-menu'),
                'child' => array(
                    'tag' => 'li',
                    'attributes' => array('class' => 'kebir-menu level-2 selected')
                )
            )
        );
        $matcher2 = array(
            'tag' => 'li',
            'child' => array(
                'tag' => 'a',
                'attributes' => array('href' => '/url1'),
                'content' => 'Menu 1'
            ),
            'descendant' => array(
                'tag' => 'a',
                'attributes' => array('href' => '/url2'),
                'content' => 'Menu 2'
            ),
        );

        $this->assertTag($matcher1, $output);
        $this->assertTag($matcher2, $output);
    }
}
