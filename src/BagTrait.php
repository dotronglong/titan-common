<?php namespace Titan\Common;

trait BagTrait
{
    /**
     * @var array
     */
    private $data = [];

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->data[$key]);
    }
}