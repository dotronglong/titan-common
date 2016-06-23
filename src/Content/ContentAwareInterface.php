<?php namespace Titan\Common\Content;

use Titan\Common\Exception\InvalidArgumentException;

interface ContentAwareInterface
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
     * @throws InvalidArgumentException
     */
    public function setContent($content);
}
