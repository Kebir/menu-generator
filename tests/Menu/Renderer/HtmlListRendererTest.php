<?php

use Kebir\Menu\MenuItem;
use Kebir\Menu\Renderer\HtmlListRenderer;
use Kebir\Menu\Selector\SimpleUrlSelector;

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
        $matcher1 = [
            'tag' => 'li',
            'attributes' => ['class' => 'kebir-menu level-1 selected has-sub-menu'],
            'child' => [
                'tag' => 'ul',
                'attributes' => ['class' => 'kebir-sub-menu'],
                'child' => [
                    'tag' => 'li',
                    'attributes' => ['class' => 'kebir-menu level-2 selected']
                ]
            ]
        ];
        $matcher2 = [
            'tag' => 'li',
            'child' => [
                'tag' => 'a',
                'attributes' => ['href' => '/url1'],
                'content' => 'Menu 1'
            ],
            'descendant' => [
                'tag' => 'a',
                'attributes' => ['href' => '/url2'],
                'content' => 'Menu 2'
            ],
        ];

        $this->assertTag($matcher1, $output);
        $this->assertTag($matcher2, $output);
    }
}
