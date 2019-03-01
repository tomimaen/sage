<?php

namespace App\Controllers\Partials;

trait SocialMediaShareUrls
{
    /**
     * Get social media share urls.
     *
     * @param object $post Post to share.
     * @return array Share urls.
     */
    public static function get_social_share_urls($post)
    {
        $socmed = new \App\Lib\SocialMediaShareUrls();

        $social_media_names = $socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks([
            'url' => get_permalink($post),
            'title' => $post->post_title,
        ]);

        return ['names' => $social_media_names, 'urls' => $social_media_urls];
    }
}
