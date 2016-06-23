<?php namespace Titan\Common\Content;

use Titan\Common\Exception\Content\InvalidContentException;

interface ParserInterface
{
    /**
     * Parse provided content
     *
     * @param string $content
     * @return mixed
     * @throws InvalidContentException
     */
    public function parse($content);
}
