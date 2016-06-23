<?php namespace Titan\Common\Content\Parser;

use Titan\Common\Content\ParserInterface;

trait ParserAwareTrait
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @return ParserInterface
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * @param ParserInterface $parser
     * @return self
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;

        return $this;
    }
}
