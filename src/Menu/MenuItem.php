<?php

namespace Kebir\Menu;

class MenuItem
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @param string $name
     * @param string $url
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Returns the name of the menu.
     *
     * @return string.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the URL of the menu.
     *
     * @return string.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the name of the menu.
     *
     * @return string.
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the URL of the menu.
     *
     * @return string.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
