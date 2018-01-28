<?php

namespace App\Kernel;

class Auth  implements \Contract\Auth
{
    public function login()
    {
        var_dump(__METHOD__);
    }
}