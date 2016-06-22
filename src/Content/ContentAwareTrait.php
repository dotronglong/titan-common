<?php namespace Titan\Common\Content;

trait ContentAwareTrait
{
    /**
     * @var string
     */
    private $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
