<?php namespace Titan\Common\Content\Parser;

use Titan\Common\Content\Parser;
use Titan\Common\Exception\Content\InvalidContentException;

class JsonParser extends Parser
{
    public function parse($content)
    {
        if (($parsedContent = json_decode($this->getContentString($content), true, 512, JSON_BIGINT_AS_STRING)) === null) {
            throw new InvalidContentException("Json string cannot be decoded or the encoded data is deeper than the recursion limit.");
        }

        return $parsedContent;
    }
}
