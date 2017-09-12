<?php

namespace Waitmoonman\Reflex\Controllers;

use Waitmoonman\Reflex\Http;
use Waitmoonman\Reflex\Request;

class IndexController
{

    /**
     * 注入一个 Request 类
     * IndexController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        echo '我是 ' . __CLASS__ . '   我依赖' . $request->className;
    }


    public function index($http)
    {
        return "我是 " . __METHOD__ . '  我依赖于';// . $http->className;
    }

}