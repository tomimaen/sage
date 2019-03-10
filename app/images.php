<?php

namespace App;

/**
 * Add new image sizes.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    add_image_size('thumbnail_no_crop', 450, 0);
    add_image_size('thumbnail_medium', 768, 0);
});

/**
 * Update existing image sizes.
 *
 * @return void
 */
add_action('admin_init', function () {
    $image_sizes = [
        [
            'name' => 'thumbnail',
            'w' => 450,
            'h' => 450,
        ],
        [
            'name' => 'medium',
            'w' => 1366,
            'h' => 0,
        ],
        [
            'name' => 'medium_large',
            'w' => 1980,
            'h' => 0,
        ],
        [
            'name' => 'large',
            'w' => 2560,
            'h' => 0,
        ]
    ];

    foreach ($image_sizes as $size) {
        $existing_w = (int) get_option($size['name'] . '_size_w');
        $existing_h = (int) get_option($size['name'] . '_size_h');

        if ($existing_w !== $size['w'] || $existing_h !== $size['h']) {
            update_option($size['name'] . '_size_h', $size['h']);
            update_option($size['name'] . '_size_w', $size['w']);
        }
    }

    update_option('image_default_align', 'none');
    update_option('image_default_link_type', 'none');
    update_option('image_default_size', 'large');
});

/**
 * Remove default image srcset max-width restriction of 1600px.
 */
add_filter('max_srcset_image_width', function () {
    return false;
});
