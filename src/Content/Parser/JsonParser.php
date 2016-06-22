<?php namespace Titan\Common\Content\Parser;

use Titan\Common\Content\Parser;
use Titan\Common\Exception\Content\InvalidContentException;

class JsonParser extends Parser
{
    public function parse($content = null)
    {
        if ($content !== null) {
            $this->setContent($content);
        }

        if (($parsedContent = json_decode($this->getContent(), true, 512, JSON_BIGINT_AS_STRING)) === null) {
            throw new InvalidContentException("Json string cannot be decoded or the encoded data is deeper than the recursion limit.");
        }

        return $parsedContent;
    }
}
