<?php


/**
 * 门面应该是留有统一的方法调用，不需要了解内部实现，为子系统提供一组接口
 * 提供统一的高级接口
 * 不需要了解门面的内部原理
 */

spl_autoload_register(function ($class) {
    // 取出 命名空间
    $path = dirname($class);
    // 取出 类名
    $class = basename($class);

    $realClass = "{$path}/{$class}.php";

    require $realClass;
});

/**
 * 注册别名
 */
$provides = require 'provides.php';
foreach ($provides as $key => $provide) {
    class_alias($provide, $key);
}

// 可以不用写命名空间了
Cache::put();
Cache::get();
Cache::has();

Auth::login();