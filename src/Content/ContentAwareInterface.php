<?php namespace Titan\Common\Content;

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
     */
    public function setContent($content);
}
