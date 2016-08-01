<?php namespace Titan\Common;

class Str
{
    public static function upperCaseFirst($string, $delimiter = null)
    {
        return static::changeFirstCase($string, $delimiter, function ($str) {
            return ucfirst($str);
        });
    }

    public static function lowerCaseFirst($string, $delimiter = null)
    {
        return static::changeFirstCase($string, $delimiter, function ($str) {
            return lcfirst($str);
        });
    }

    private static function changeFirstCase($string, $delimiter, $callback)
    {
        return $delimiter === null ? $callback($string) : preg_replace_callback("/^([a-zA-Z])|\\$delimiter([a-zA-Z])/i",
            function ($matches) use ($delimiter, $callback) {
                return isset($matches[2]) ? $delimiter . $callback($matches[2]) : $callback($matches[0]);
            }, $string);
    }
}