<?php namespace Titan\Common\Stream;

use Titan\Common\StreamInterface;

interface StreamAwareInterface
{
    /**
     * @return StreamInterface
     */
    public function getStream();

    /**
     * @param StreamInterface $stream
     * @return self
     */
    public function setStream(StreamInterface $stream);
}
