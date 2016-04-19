<?php

use Kebir\MenuGenerator\MenuItem;
use Kebir\MenuGenerator\Renderer\HtmlListRenderer;
use Kebir\MenuGenerator\Selector\SimpleUrlSelector;
use Symfony\Component\DomCrawler\Crawler;

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

        $crawler = new Crawler($output);

        $this->assertEquals(1, $crawler->filter('.kebir-menu.level-1.has-sub-menu')->count());
        $this->assertEquals(1, $crawler->filter('.kebir-menu.level-1.selected.has-sub-menu')->count());
        $this->assertEquals(1, $crawler->filter('.kebir-menu.level-2.selected')->count());
        $this->assertEquals(1, $crawler->filter('.kebir-menu > a[href="/url1"]')->count());
        $this->assertEquals(1, $crawler->filter('.kebir-menu .kebir-menu.level-2 > a[href="/url2"]')->count());
    }
}
