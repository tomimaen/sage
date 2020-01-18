<?php

namespace App\Controllers\Partials;

trait NavigationMenu
{
    public function __construct()
    {
        add_filter('tree_nav_menu_item', [$this, 'setMenuItemProperties'], 10, 1);
    }

    /**
     * Get menu by either menu name or theme location.
     *
     * @param string $menu Menu name or theme location.
     * @return array|false|string
     */
    public static function getMenu($menu)
    {
        $locations = get_nav_menu_locations();

        if (!isset($locations[$menu])) {
            return false;
        }

        $menu = $locations[$menu];

        $walker = new \App\Lib\TreeWalkerNavMenu();
        $items = wp_get_nav_menu_items($menu);
        _wp_menu_item_classes_by_context($items);

        return $walker->walk($items, 0);
    }

    /**
     * Set menu item object properties.
     *
     * @param object $menu_item Menu item.
     * @return object
     */
    public static function setMenuItemProperties($menu_item)
    {
        // @todo set active classes as needed

        return $menu_item;
    }
}
