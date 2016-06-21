<?php namespace Titan\Common;

use Titan\Common\Exception\InvalidArgumentException;

class Stream implements StreamInterface
{
    const STREAM_READ  = 'read';
    const STREAM_WRITE = 'write';

    const META_SEEKABLE = 'seekable';
    const META_SIZE     = 'size';
    const META_URI      = 'uri';
    const META_MODE     = 'mode';

    /**
     * @var array
     */
    private static $readWriteHash = [
        self::STREAM_READ  => [
            'r'   => true,
            'w+'  => true,
            'r+'  => true,
            'x+'  => true,
            'c+'  => true,
            'rb'  => true,
            'w+b' => true,
            'r+b' => true,
            'x+b' => true,
            'c+b' => true,
            'rt'  => true,
            'w+t' => true,
            'r+t' => true,
            'x+t' => true,
            'c+t' => true,
            'a+'  => true,
        ],
        self::STREAM_WRITE => [
            'w'   => true,
            'w+'  => true,
            'rw'  => true,
            'r+'  => true,
            'x+'  => true,
            'c+'  => true,
            'wb'  => true,
            'w+b' => true,
            'r+b' => true,
            'x+b' => true,
            'c+b' => true,
            'w+t' => true,
            'r+t' => true,
            'x+t' => true,
            'c+t' => true,
            'a'   => true,
            'a+'  => true,
        ],
    ];

    /**
     * @var resource
     */
    protected $stream;

    /**
     * @var bool
     */
    protected $seekable = false;

    /**
     * @var bool
     */
    protected $readable = false;

    /**
     * @var bool
     */
    protected $writable = false;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array
     */
    protected $metaData = [];

    public function __construct($source, $mode = 'r')
    {
        if (($this->stream = fopen($source, $mode)) === false) {
            throw new InvalidArgumentException("Could not open stream with $source.");
        }

        $this->metaData = stream_get_meta_data($this->stream);
        $this->seekable = $this->metaData[static::META_SEEKABLE];
        $this->readable = isset(static::$readWriteHash[static::STREAM_READ][$this->getMetadata(static::META_MODE)]);
        $this->writable = isset(static::$readWriteHash[static::STREAM_WRITE][$this->getMetadata(static::META_MODE)]);
        $this->uri      = $this->metaData[static::META_URI];
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }

    public function detach()
    {
        $stream = $this->stream;
        unset($this->stream);
        $this->size     = $this->uri = null;
        $this->readable = $this->writable = $this->seekable = false;

        return $stream;
    }

    public function eof()
    {
        return feof($this->stream);
    }

    public function getContents()
    {
        $contents = stream_get_contents($this->stream);
        if ($contents === false) {
            throw new \RuntimeException('Unable to read stream contents');
        }

        return $contents;
    }

    public function getMetadata($key = null)
    {
        return isset($this->metaData[$key]) ? $this->metaData[$key] : null;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function __toString()
    {
        try {
            $this->seek(0);

            return (string) stream_get_contents($this->stream);
        } catch (\Exception $e) {
            return '';
        }
    }

    public function read($length)
    {
        if (!$this->isReadable()) {
            throw new \RuntimeException('Cannot read from non-readable stream');
        }

        return fread($this->stream, $length);
    }

    public function isReadable()
    {
        return $this->readable;
    }

    public function rewind()
    {
        if ($this->isSeekable()) {
            rewind($this->stream);
        } else {
            throw new \RuntimeException('Stream is not seekable');
        }
    }

    public function isSeekable()
    {
        return $this->seekable;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        if (!$this->isSeekable()) {
            throw new \RuntimeException('Stream is not seekable');
        } elseif (fseek($this->stream, $offset, $whence) === -1) {
            throw new \RuntimeException('Unable to seek to stream position '
                . $offset . ' with whence ' . var_export($whence, true));
        }
    }

    public function tell()
    {
        if (!$this->isSeekable() || ($position = ftell($this->stream)) === false) {
            throw new \RuntimeException('Unable to find current position of stream');
        }

        return $position;
    }

    public function write($string)
    {
        if (!$this->isWritable()) {
            throw new \RuntimeException('Cannot write to a non-writable stream');
        }

        if (($bytes = fwrite($this->stream, $string)) === false) {
            throw new \RuntimeException('Unable to write to stream');
        }
        $this->size = $this->calculateSize();

        return $bytes;
    }

    public function isWritable()
    {
        return $this->writable;
    }

    /**
     * Calculate current size of stream
     *
     * @return int|null
     */
    private function calculateSize()
    {
        // Clear the stat cache if the stream has a URI
        if ($this->uri) {
            clearstatcache(true, $this->uri);
        }

        $stats = fstat($this->stream);
        if (isset($stats[static::META_SIZE])) {
            $this->size = $stats[static::META_SIZE];

            return $this->size;
        }

        return null;
    }
}
