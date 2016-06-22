<?php namespace Titan\Common\Content\Parser;

use Titan\Common\Content\Parser;
use Titan\Common\Exception\Content\InvalidContentException;

class XmlParser extends Parser
{
    /**
     * @inheritDoc
     */
    public function parse($content = null)
    {
        throw new InvalidContentException('Write code first.');
    }
}