<?php namespace Titan\Common\Content;

use Titan\Common\Exception\InvalidArgumentException;
use Titan\Common\Stringable;

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
        if ($content instanceof Stringable) {
            $this->content = (string) $content;
        } elseif (is_resource($content)) {
            throw new InvalidArgumentException('Content must not be a resource.');
        } else {
			$this->content = $content;
		}

        return $this;
    }
}
