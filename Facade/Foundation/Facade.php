<?php

namespace Foundation;

class Facade
{
    public static function getFacade()
    {
        return '';
    }

    public static function __callStatic($method, $parameters)
    {
        $instance = static::getFacade();
        return $instance->$method(...$parameters);
    }
}