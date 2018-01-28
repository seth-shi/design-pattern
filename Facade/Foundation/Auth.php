<?php

namespace Foundation;

class Auth extends Facade
{
    public static function getFacade()
    {
        return new \App\Kernel\Auth();
    }
}