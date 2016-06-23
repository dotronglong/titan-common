<?php namespace Titan\Common\Content;

use Titan\Common\Exception\InvalidArgumentException;

interface ContentAwareInterface
{
    /**
     * Return content
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Set content
     *
     * @param mixed $content
     * @return self
     * @throws InvalidArgumentException Exception raises when content is a resource
     */
    public function setContent($content);
}
