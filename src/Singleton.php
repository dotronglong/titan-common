<?php namespace Titan\Common;

abstract class Singleton implements InstanceInterface
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * Get global instance
     *
     * @return static
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = self::newInstance();
        }

        return self::$instance;
    }

    /**
     * Set global instance for class
     *
     * @param static $instance
     */
    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }

    /**
     * Return new instance of class
     *
     * @return static
     */
    public static function newInstance()
    {
        return new static;
    }
}
