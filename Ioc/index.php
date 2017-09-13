<?php

    require 'Container.php';


    class User
    {

    }

    $container = new Container();

    // 绑定一个 PDO 实例
    $container->bind('db', new PDO('mysql:host=localhost;dbname=test', 'root', 'root'));
    // 绑定一个 PHP 基类
    $container->bind('base', new StdClass());
    // 绑定一个用户类
    $container->bind('user', new User());

    // 获取实例
    $dbh = $container->get('db');
    $base = $container->get('base');

    $is_user = $container->has('user');

    var_dump($dbh, $base, $is_user);
/*************************************************
 F:\phpStudy\WWW\designPattern\Ioc\index.php:26:
class PDO#2 (0) {
}
F:\phpStudy\WWW\designPattern\Ioc\index.php:26:
class stdClass#3 (0) {
}
F:\phpStudy\WWW\designPattern\Ioc\index.php:26:
bool(true)
 */