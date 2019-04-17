<?php

namespace App\Controllers\Partials;

trait Media
{
    /**
     * Create lazyload image markup.
     *
     * @param string $markup Image markup.
     * @param string $class Lazyload class.
     * @return string Lazyloadable image markup.
     */
    public static function lazyImage($markup, $class = 'lazy')
    {
        $no_js = sprintf('<noscript>%s</noscript>', $markup);
        $js = $markup;

        $replacements = [
            'class="' => sprintf('class="%s ', $class),
            'src' => 'data-src',
        ];

        $js = strtr($js, $replacements);

        return $no_js . $js;
    }

    /**
     * Create lazyload iframe markup.
     *
     * @param string $markup WordPress [embed] markup.
     * @param string $class Lazyload class.
     * @param bool $noscript Add <noscript> markup.
     * @return string Lazyloadable WordPress [embed] markup.
     */
    public static function lazyIframe($markup, $class = 'lazy', $noscript = true)
    {
        $no_js = $noscript ? sprintf('<noscript>%s</noscript>', $markup) : '';
        $js = $markup;

        $replacements = [
            'iframe' => sprintf('iframe class="%s"', $class),
            'src' => 'data-src',
        ];

        $js = strtr($js, $replacements);

        return $no_js . $js;
    }
}
