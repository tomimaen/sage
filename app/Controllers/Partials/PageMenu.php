<?php

namespace App\Controllers\Partials;

trait PageMenu
{
    /**
     * Get page menu.
     *
     * @param array $get_pages_args get_pages() function args.
     * @return array
     */
    public static function get_page_menu($get_pages_args = [])
    {
        $get_pages_args = wp_parse_args([
            'sort_column' => 'menu_order',
            'child_of' => self::get_page_ancestor(),
        ], $get_pages_args);

        $walker = new \App\Lib\TreeWalkerPage();
        $pages = get_pages($get_pages_args);

        return $walker->walk($pages, 0);
    }

    /**
     * Get highest ancestor for current page structure.
     *
     * @return int
     */
    public static function get_page_ancestor()
    {
        global $post;

        $post_ancestors = $post->ancestors ?? get_post_ancestors($post);
        return $post_ancestors ? end($post_ancestors) : $post->ID;
    }
}
