Menu Generator
==============
Installations
----------------
Install through composer:

    {
        require: {
            "kebir/menu-generator": "dev-master"
        }
    }

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
$builder = new Kebir\MenuGenerator\Builder();
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
class that will display the menus using html &lt;ul&gt; and &lt;li&gt; tags.
The class requires an instance of `Kebir\MenuGenerator\Selector\Selector` which
is responsible of detecting if a menu should considered as selected.

```php
<?php

$current_url = 'http://test.com/page1';
$simple_selector = new Kebir\MenuGenerator\Selector\SimpleUrlSelector($current_url);
$renderer = new Kebir\MenuGenerator\Renderer\HtmlListRenderer($simple_selector);
echo "<ul>";
foreach ($menus as $menu) {
    $renderer->render($menu);
}
echo "</ul>";

```

Laravel Users
-------------------

The package includes a Service Provider and a Facade for the Renderer. Edit the `app/config/app.php`:
```php
<?php

  //Add the service provider
  'Kebir\MenuGenerator\MenuGeneratorServiceProvider'
  ...
  //add the facade alias
  'MenuRenderer'    => 'Kebir\MenuGenerator\Facades\Renderer'

```
To use it, simply call the following in your blade template for example:

    {{ MenuRender::render($menu) }}

### Menu Selection
To mark a menu as selected, you can use the `Kebir\MenuGenerator\Selector\SimpleUrlSelector` class when creating the menu renderer.

For laravel users, the service provider is configured to include the `Kebir\MenuGenerator\Selector\LaravelSelector` instead. This will allow you, in the config file provided, to define which entry in the menu should be selected when a page is reached. 

This is very useful when the current page is not in the menu but is related to another url which is in the menu. Here is an example of usage for the [`config/config.php`](https://github.com/Kebir/menu-generator/blob/dev/src/config/config.php) file

```php
<?php
return array(
   //To link /users/1/edit to another url /users in the menu.
   'linked_urls' => array(
        '/users/1/edit' => '/users'
    ),
    
    //To link an action to an url
    'linked_actions' => array(
        'UsersController@edit' => '/users'
    ),
    
    //To link a route to an url
    'linked_routes' => array(
        'user_edit_path' => '/users'
    )
);
```
