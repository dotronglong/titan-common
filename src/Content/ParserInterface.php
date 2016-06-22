<?php namespace Titan\Common\Content;

use Titan\Common\Exception\Content\InvalidContentException;
use Titan\Common\StreamInterface;

interface ParserInterface
{
    /**
     * Return content of parser
     *
     * @return string
     */
    public function getContent();

    /**
     * Set content of parser
     *
     * @param string $content
     * @return self
     */
    public function setContent($content);

    /**
     * @return StreamInterface
     */
    public function getStream();

    /**
     * @param StreamInterface $stream
     * @return self
     */
    public function setStream(StreamInterface $stream);

    /**
     * Parse content. If there is no specified content, use inside content instead
     *
     * @param null|string $content
     * @return mixed
     * @throws InvalidContentException
     */
    public function parse($content = null);
}
