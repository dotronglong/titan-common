<?php namespace Titan\Common\Content;

trait HasContentTrait
{
    /**
     * @var string
     */
    protected $content;

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
