<?php

namespace App\Controllers\Partials;

trait SocialMediaShareUrls
{
    /**
     * Get social media share links
     *
     * @return array Share links.
     */
    public static function getSocialShareUrls($post)
    {
        $socmed = new \App\Lib\SocialMediaShareUrls();

        $social_media_names = $socmed->GetSocialMediaSitesWithShareLinksOrderedByPopularity();
        $social_media_urls = $socmed->GetSocialMediaSiteLinksWithShareLinks([
            'url' => get_permalink($post),
            'title' => $post->post_title,
        ]);

        return ['names' => $social_media_names, 'urls' => $social_media_urls];
    }
}
