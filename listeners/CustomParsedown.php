<?php

namespace App\Listeners;

use ParsedownExtra as BaseParsedown;

class CustomParsedown extends BaseParsedown
{
    /**
     * Extra link handling
     * @param  array $Excerpt
     * @return array
     */
    protected function inlineLink($Excerpt)
    {
        $Link = parent::inlineLink($Excerpt);

        if (! isset($Link)) {
            return null;
        }

        $href = $Link['element']['attributes']['href'];

        if (preg_match('/#(.+)/', $href, $matches)) {
            $Link['element']['attributes']['class'] = 'scroll-to';
        }

        return $Link;
    }
}
