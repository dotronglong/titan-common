<?php namespace Titan\Tests\Common;

use ReflectionClass;
use InvalidArgumentException;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Invoke Object Method by name
     *
     * @param object $instance Instance of be invoked
     * @param string $name Name of method
     * @param array $arguments Method's arguments
     * @return mixed
     */
    protected function invokeMethod($instance, $name, $arguments = [])
    {
        $object = new ReflectionClass(get_class($instance));
        if ($object->hasMethod($name)) {
            $method = $object->getMethod($name);
            $method->setAccessible(true);
            return $method->invokeArgs($instance, is_array($arguments) ? $arguments : [$arguments]);
        }
    }

    protected function invokeProperty($instance, $name, $value = null)
    {
        $prop = $this->invokeGetProperty($instance, $name);
        if ($prop === null) {
            throw new InvalidArgumentException("Property $name does not exist");
        }

        $prop->setAccessible(true);
        if ($value === null) {
            return $prop->getValue($instance);
        } else {
            $prop->setValue($instance, $value);
            return $value;
        }
    }

    protected function invokeGetProperty($instance, $name)
    {
        $object = new ReflectionClass(is_object($instance) ? get_class($instance) : $instance);
        if ($object->hasProperty($name)) {
            return $object->getProperty($name);
        }

        return null;
    }

    /**
     * Check an array of expected class items
     *
     * @param $expected
     * @param $array
     */
    public function assertArrayInstanceOf($expected, $array)
    {
        if (is_array($array) && count($array)) {
            foreach ($array as $item) {
                $this->assertInstanceOf($expected, $item);
            }
        } else {
            $this->assertFalse(true, 'Expect array');
        }
    }
}