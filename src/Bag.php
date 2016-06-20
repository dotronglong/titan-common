<?php namespace Titan\Common;

class Bag implements BagInterface
{
    use BagTrait;

    public function __construct(array $data = [])
    {
        $this->replace($data);
    }
}
