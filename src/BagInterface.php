<?php namespace Titan\Common;

interface BagInterface
{
    /**
     * Define whether a key exists
     *
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * Get a key's value
     *
     * @param string $key
     * @param null   $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Set a key
     *
     * @param string $key
     * @param $value
     */
    public function set($key, $value);

    /**
     * Remove a key
     *
     * @param string $key
     */
    public function remove($key);

    /**
     * Remove all keys
     */
    public function clean();
}