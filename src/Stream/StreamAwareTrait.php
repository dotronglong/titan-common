<?php namespace Titan\Common\Stream;

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
