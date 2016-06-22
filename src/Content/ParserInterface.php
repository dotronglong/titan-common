<?php namespace Titan\Common\Content;

use Titan\Common\Exception\Content\InvalidContentException;
use Titan\Common\Stream\StreamAwareInterface;

interface ParserInterface extends StreamAwareInterface, ContentAwareInterface
{
    /**
     * Parse content. If there is no specified content, use inside content instead
     *
     * @param null|string $content
     * @return mixed
     * @throws InvalidContentException
     */
    public function parse($content = null);
}
