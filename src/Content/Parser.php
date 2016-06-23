<?php namespace Titan\Common\Content;

use Titan\Common\Stringable;

abstract class Parser implements ParserInterface
{
    protected function getContentString($content)
    {
        if (is_string($content)) {
            return $content;
        } elseif ($content instanceof Stringable) {
            return (string) $content;
        }

        return '';
    }
}
