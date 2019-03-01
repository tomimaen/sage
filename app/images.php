<?php

namespace App;

/**
 * Update existing image sizes and add new ones.
 */
add_action('after_setup_theme', function () {
    add_image_size('thumbnail', 450, 450, true);
    add_image_size('medium', 1366, 0, false);
    add_image_size('medium_large', 1980, 0, false);
    add_image_size('large', 2560, 0, false);

    add_image_size('thumbnail_no_crop', 450, 0, false);
    add_image_size('thumbnail_medium', 768, 0, false);

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
