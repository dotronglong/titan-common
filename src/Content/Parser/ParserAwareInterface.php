<?php namespace Titan\Common\Content\Parser;

use Titan\Common\Content\ParserInterface;

interface ParserAwareInterface
{
    /**
     * @return ParserInterface
     */
    public function getParser();

    /**
     * @param ParserInterface $parser
     * @return self
     */
    public function setParser(ParserInterface $parser);
}
