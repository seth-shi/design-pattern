<?php

namespace Foundation;

class Cache extends Facade
{
    public static function getFacade()
    {
        return new \App\Real\Cache();
    }
}