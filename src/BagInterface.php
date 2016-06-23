<?php namespace Titan\Common;

interface BagInterface
{
    /**
     * Get all keys
     *
     * @return array
     */
    public function all();

    /**
     * Remove all keys
     */
    public function clean();

    /**
     * Get a key's value
     *
     * @param string $key
     * @param null   $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Define whether a key exists
     *
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * Get only some specific keys
     *
     * @param array $keys
     * @return array
     */
    public function only(array $keys);

    /**
     * Remove a key
     *
     * @param string $key
     */
    public function remove($key);

    /**
     * Replace all current data to new one
     *
     * @param array $data
     */
    public function replace(array $data);

    /**
     * Set a key
     *
     * @param string $key
     * @param $value
     */
    public function set($key, $value);
}
