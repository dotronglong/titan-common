<?php namespace Titan\Tests\Common;

use Titan\Common\Bag;

class BagTest extends TestCase
{
    public function testAll()
    {
        $data = [
            'a' => 'b',
            'c' => 'd'
        ];
        $bag  = $this->getInstance();
        $this->invokeProperty($bag, 'data', $data);
        $this->assertEquals($data, $bag->all());
    }

    private function getInstance()
    {
        return new Bag();
    }

    public function testClean()
    {
        $data = [
            'a' => 'b',
            'c' => 'd'
        ];
        $bag  = $this->getInstance();
        $this->invokeProperty($bag, 'data', $data);
        $bag->clean();
        $this->assertEquals([], $bag->all());
    }

    public function testGet()
    {
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', ['foo' => 'baz']);
        $this->assertEquals('baz', $bag->get('foo'));
    }

    public function testHas()
    {
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', ['foo' => 'baz']);
        $this->assertTrue($bag->has('foo'));
    }

    public function testOnly()
    {
        $data = [
            'a' => 'b',
            'c' => 'd',
            'e' => 'f'
        ];
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', $data);
        $this->assertEquals(['a' => 'b', 'e' => 'f'], $bag->only(['a', 'e']));
    }

    public function testRemove()
    {
        $bag = $this->getInstance();
        $bag->set('foo', 'baz');
        $bag->remove('foo');
        $this->assertFalse($bag->has('foo'));
    }

    public function testReplace()
    {
        $oldData = ['a' => 'b'];
        $newData = [
            'c' => 'd',
            'e' => 'f'
        ];
        $bag = $this->getInstance();
        $this->invokeProperty($bag, 'data', $oldData);
        $this->assertEquals($oldData, $this->invokeProperty($bag, 'data'));
        $bag->replace($newData);
        $this->assertEquals($newData, $this->invokeProperty($bag, 'data'));
    }

    public function testSet()
    {
        $bag = $this->getInstance();
        $bag->set('foo', 'baz');
        $this->assertEquals('baz', $bag->get('foo'));
    }
}
