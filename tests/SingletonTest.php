<?php namespace Titan\Tests\Common;

class SingletonTest extends TestCase
{
    public function testGetInstance()
    {
        $this->assertInstanceOf(SingletonSample::class, SingletonSample::getInstance());
    }

    public function testSetInstance()
    {
        $sample = new SingletonSample();
        SingletonSample::setInstance($sample);
        $this->assertEquals($sample, SingletonSample::getInstance());
    }
}
