Menu Generator
==============
Installation
----------------
Install through composer:

    composer require kebir/menu-generator:1.*

Usage
---------

```php
<?php

//Given this list of menus
$menus = [
    ["id" => 1, "name" => "Menu 1", "url" => "test.com", "parent_id" => 3],
    ["id" => 2, "name" => "Menu 2", "url" => "test.com", "parent_id" => 0],
    ["id" => 3, "name" => "Menu 3", "url" => "test.com", "parent_id" => 0],
    ["id" => 4, "name" => "Menu 4", "url" => "test.com", "parent_id" => 2],
    ["id" => 5, "name" => "Menu 5", "url" => "test.com", "parent_id" => 3],
    ["id" => 6, "name" => "Menu 6", "url" => "test.com", "parent_id" => 1],
];

//Let's build a hierarchical menus list
$builder = new Kebir\Menu\Builder();
$menus_generated = $builder->build($menus);

//Check the output
foreach ($menus as $menu) {
    echo $menu->getName() . "-" . $menu->getUrl()."\n";
    foreach ($menu->getElements() as $submenu) {
        echo "--- ".$submenu->getName()."\n";
    }
}
/** output
    Menu 2 - test.com
        --- Menu 4
    Menu 3 - test.com
        --- Menu 1
        --- Menu 5
*/

```

If you want to display the menu, the package provides a HtmlListRenderer
class that will display the menus using html &lt;ul&gt; and &lt;li&gt; tags:

```php
<?php

$current_url = 'http://test.com/page1';
$renderer = new Kebir\Renderer\HtmlListRenderer($current_url);
echo "<ul>";
foreach ($menus as $menu) {
    $renderer->render($menu);
}
echo "</ul>";

```

Laravel Users
-------------------

The package includes a Service Provider and a Facade for the Renderer:

```php
<?php

//config/app.php

  //Add the service provider
  'Kebir\Menu\MenuServiceProvider'
  ...
  //add the facade alias
  'MenuRenderer'    => 'Kebir\Menu\Facades\Renderer'

```
To use it, simply call the following in your blade template for example:

    {{ MenuRender::render($menu) }}
