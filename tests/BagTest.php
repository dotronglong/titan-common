<?php namespace Titan\Tests\Common;

use Titan\Common\Bag;

class BagTest extends TestCase
{
    private function getInstance()
    {
        return new Bag();
    }

    public function testHas()
    {
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', ['foo' => 'baz']);
        $this->assertTrue($bag->has('foo'));
    }

    public function testGet()
    {
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', ['foo' => 'baz']);
        $this->assertEquals('baz', $bag->get('foo'));
    }

    public function testSet()
    {
        $bag = $this->getInstance();
        $bag->set('foo', 'baz');
        $this->assertEquals('baz', $bag->get('foo'));
    }

    public function testRemove()
    {
        $bag = $this->getInstance();
        $bag->set('foo', 'baz');
        $bag->remove('foo');
        $this->assertFalse($bag->has('foo'));
    }
}