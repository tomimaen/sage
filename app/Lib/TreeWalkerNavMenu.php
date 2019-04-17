<?php

namespace App\Lib;

/**
 * Tree Walker Nav Menu
 *
 * WordPress Nav Menu Walker that returns menu items as multidimensional object (items with children).
 *
 * @see https://gist.github.com/kucrut/efb593d4b263a4b1b6df2549a746a29c
 */
class TreeWalkerNavMenu extends \Walker_Nav_Menu
{

    /**
     * Check if any of the array of values exist in array.
     *
     * @param $needles
     * @param $haystack
     * @return bool
     */
    protected function inArrayAny($needles, $haystack)
    {
        return ! empty(array_intersect($needles, $haystack));
    }

    /**
     * Prepare item
     *
     * @param  object $item  Menu Item.
     * @param  array  $args  Arguments passed to walk().
     * @param  int    $depth Item's depth.
     * @return object
     */
    protected function prepareItem($item, $args, $depth)
    {
        $title   = apply_filters('the_title', $item->title, $item->ID);
        $title   = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        $classes = apply_filters('nav_menu_css_class', array_filter($item->classes), $item, $args, $depth);

        $item = (object) [
            'id'               => absint($item->ID),
            'order'            => (int) $item->menu_order,
            'parent'           => absint($item->menu_item_parent),
            'title'            => $title,
            'url'              => $item->url,
            'attr'             => $item->attr_title,
            'target'           => $item->target,
            'classes'          => $classes,
            'xfn'              => $item->xfn,
            'description'      => $item->description,
            'object_id'        => absint($item->object_id),
            'object'           => $item->object,
            'type'             => $item->type,
            'type_label'       => $item->type_label,
            'current'          => $this->inArrayAny(
                [
                    'current-menu-item',
                    'current_page_item',
                ],
                $classes
            ),
            'current_parent'   => $this->inArrayAny(
                [
                    'current-menu-parent',
                    'current_page_parent',
                    "current-{$item->object}-parent",
                    "current-{$item->type}-parent"
                ],
                $classes
            ),
            'current_ancestor' => $this->inArrayAny(
                [
                    'current-menu-ancestor',
                    'current_page_ancestor',
                    "current-{$item->object}-ancestor",
                    "current-{$item->type}-ancestor"
                ],
                $classes
            ),
            'children'         => [],
        ];

        return apply_filters('tree_nav_menu_item', $item);
    }

    /**
     * Traverse elements to create list from elements.
     *
     * This method should not be called directly, use the walk() method instead.
     *
     * @param object $element           Data object.
     * @param array  $children_elements List of elements to continue traversing.
     * @param int    $max_depth         Max depth to traverse.
     * @param int    $depth             Depth of current element.
     * @param array  $args              An array of arguments.
     * @param array  $output            Passed by reference. Used to append additional content.
     */
    // @codingStandardsIgnoreLine PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (! $element) {
            return;
        }

        if (! is_array($output)) {
            $output = [];
        }

        $id_field = $this->db_fields['id'];
        $id       = $element->$id_field;
        $item     = $this->prepareItem($element, $args, $depth);

        if (! empty($children_elements[ $id ])) {
            foreach ($children_elements[ $id ] as $child) {
                $this->display_element(
                    $child,
                    $children_elements,
                    1,
                    ( $depth + 1 ),
                    $args,
                    $item->children
                );
            }

            unset($children_elements[ $id ]);
        }

        $output[] = $item;
    }
}
