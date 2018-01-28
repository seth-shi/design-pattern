<?php

namespace App\Real;

class Cache  implements \Contract\Cache
{
    public function get()
    {
        var_dump(__METHOD__);
    }

    public function put()
    {
        var_dump(__METHOD__);
    }

    public function has()
    {
        var_dump(__METHOD__);
    }

}