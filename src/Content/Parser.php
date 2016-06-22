<?php namespace Titan\Common\Content;

use Titan\Common\StreamAwareTrait;

abstract class Parser implements ParserInterface
{
    use ContentAwareTrait, StreamAwareTrait;
}
