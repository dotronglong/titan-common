<?php namespace Titan\Common\Content;

use Titan\Common\HasStreamTrait;

abstract class Parser implements ParserInterface
{
    use HasContentTrait, HasStreamTrait;
}
