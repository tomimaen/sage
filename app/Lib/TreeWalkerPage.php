<?php

namespace App\Lib;

/**
 * Tree Walker Page
 *
 * WordPress Page Walker that returns pages as multidimensional object (items with children).
 */
class TreeWalkerPage extends \Walker_Page
{

    // @codingStandardsIgnoreLine PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
    }

    // @codingStandardsIgnoreLine PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
    }

    // @codingStandardsIgnoreLine PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)
    {
    }

    // @codingStandardsIgnoreLine PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function end_el(&$output, $object, $depth = 0, $args = array())
    {
    }

    /**
     * Prepare item.
     *
     * @param object $element Page object.
     * @return object
     */
    public function prepareItem($element)
    {
        $current_page = get_the_ID();
        $_current_page = $current_page ? get_post($current_page) : false;

        $element->current = $element->ID === $current_page;

        if ($_current_page) {
            $element->current_parent = $element->ID === $_current_page->post_parent;
            $element->current_ancestor = in_array($element->ID, $_current_page->ancestors);
        }

        return apply_filters('bridge_page_menu_item', $element);
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
    public function display_element($element, &$children, $max_depth, $depth, $args, &$output)
    {
        if (! is_array($output)) {
            $output = [];
        }

        $element = $this->prepareItem($element);

        if (0 === $depth) {
            $output[$element->ID] = $element;
        }

        if (isset($children[$element->ID])) {
            $element->children = $children[$element->ID];
        }

        parent::display_element($element, $children, $max_depth, $depth, $args, $output);
    }
}
