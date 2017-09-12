<?php

namespace Waitmoonman\Reflex;

class Request
{
    public $className;

    public function __construct(Http $http)
    {
        $this->className = __CLASS__;

        $this->className = $this->className . '  ->  ' . $http->className;
    }
}