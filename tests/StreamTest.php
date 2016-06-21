<?php namespace Titan\Tests;

use Titan\Common\Stream;
use Titan\Common\StreamInterface;
use Titan\Tests\Common\TestCase;
use RuntimeException;

function fwrite($str, $len)
{
    echo 'xxx';die;
}

class StreamTest extends TestCase
{
    /**
     * @type StreamInterface
     */
    private $stream;

    /**
     * @type string
     */
    private $text = 'hello_world';

    public function tearDown()
    {
        if ($this->stream !== null) {
            $this->stream->close();
        }
    }

    private function getInstance($source = Stream::PHP_TEMP, $mode = 'rw')
    {
        return new Stream($source, $mode);
    }

    public function testGetSize()
    {
        $this->stream = $this->getInstance();
        $this->assertEquals(0, $this->stream->getSize());

        $size = strlen($this->text);
        $this->stream->write($this->text);
        $this->assertEquals($size, $this->stream->getSize());
    }

    public function testEof()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->assertFalse($this->stream->eof());

        $this->stream->seek(0, SEEK_END);
        $this->stream->read(1);
        $this->assertTrue($this->stream->eof());
    }

    public function testTell()
    {
        $this->stream = $this->getInstance();
        $this->assertEquals(0, $this->stream->tell());
        $this->stream->write($this->text);
        $this->assertEquals(strlen($this->text), $this->stream->tell());
    }

    public function testTellThrowRuntimeException()
    {
        $stream = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->setMethods(['isSeekable'])->getMock();
        $stream->expects($this->once())->method('isSeekable')->willReturn(false);
        $this->expectException(RuntimeException::class);
        $stream->tell();
    }

    public function testRead()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->stream->rewind();
        $this->assertEquals($this->text, $this->stream->read(strlen($this->text)));
    }

    public function testReadThrowRuntimeException()
    {
        $stream = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->setMethods(['isReadable'])->getMock();
        $stream->expects($this->once())->method('isReadable')->willReturn(false);
        $this->expectException(RuntimeException::class);
        $stream->read(1);
    }

    public function testRewind()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->assertEquals(strlen($this->text), $this->stream->tell());
        $this->stream->rewind();
        $this->assertEquals(0, $this->stream->tell());
    }

    public function testRewindThrowRuntimeException()
    {
        $stream = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->setMethods(['isSeekable'])->getMock();
        $stream->expects($this->once())->method('isSeekable')->willReturn(false);
        $this->expectException(RuntimeException::class);
        $stream->rewind();
    }

    public function testSeek()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->assertEquals(strlen($this->text), $this->stream->tell());
        $this->stream->rewind();
        $this->stream->seek(5);
        $this->assertEquals(5, $this->stream->tell());
    }

    public function testSeekThrowExceptionIfNotSeekable()
    {
        $stream = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->setMethods(['isSeekable'])->getMock();
        $stream->expects($this->once())->method('isSeekable')->willReturn(false);
        $this->expectException(RuntimeException::class);
        $stream->seek(5);
    }

    public function testSeekThrowExceptionIfFailed()
    {
        $this->expectException(RuntimeException::class);
        $this->stream = $this->getInstance();
        $this->stream->seek(10);
    }

    public function testWrite()
    {
        $this->stream = $this->getInstance();
        $this->assertEquals(strlen($this->text), $this->stream->write($this->text));
    }

    public function testWriteThrowRuntimeExceptionIfNotWritable()
    {
        $stream = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->setMethods(['isWritable'])->getMock();
        $stream->expects($this->once())->method('isWritable')->willReturn(false);
        $this->expectException(RuntimeException::class);
        $stream->write($this->text);
    }

    public function testToString()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->assertEquals($this->text, (string) $this->stream);
    }

    public function testGetContents()
    {
        $this->stream = $this->getInstance();
        $this->stream->write($this->text);
        $this->stream->rewind();

        $size = strlen($this->text);
        $seek = rand(1, $size - 1);
        $this->stream->seek($seek);
        $this->assertEquals(substr($this->text, $seek, $size), $this->stream->getContents());
    }
}