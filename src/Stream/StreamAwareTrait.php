<?php namespace Titan\Common;

trait StreamAwareTrait
{
    /**
     * @var StreamInterface
     */
    private $stream;

    public function getStream()
    {
        return $this->stream;
    }

    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }
}
