<?php

namespace App\Listeners;

use App\Listeners\CustomParsedown;
use Mni\FrontYAML\Markdown\MarkdownParser;

class ParsedownParser implements MarkdownParser
{
    /**
     * ParsedownParser constructor.
     */
    public function __construct()
    {
        $this->parser = new CustomParsedown();
    }

    /**
     * @param  string $markdown
     * @return  string
     */
    public function parse($markdown)
    {
        return $this->parser->text($markdown);
    }
}
