<?php namespace Titan\Common;

trait BagTrait
{
    /**
     * @var array
     */
    private $data = [];

    public function all()
    {
        return $this->data;
    }

    public function clean()
    {
        $this->data = [];
    }

    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function only(array $keys)
    {
        return array_intersect_key($this->data, array_flip($keys));
    }

    public function remove($key)
    {
        unset($this->data[$key]);
    }

    public function replace(array $data)
    {
        $this->data = $data;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
}