<?php

    // 要实现自动载入
    use DavidNineRoc\Reflex\Application;

    require 'vendor/autoload.php';


    // new 一个 ReflectionClass 类， 放入需要实例的类名
    $response = Application::run(\DavidNineRoc\Reflex\Controllers\IndexController::class, 'index', [], ['ddd']);
    var_dump($response);