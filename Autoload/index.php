<?php
    
    define('ROOT_PATH', dirname(__FILE__));

    // 引入自动加载文件
    require 'AutoLoad.php';
    // 注册加载类
    spl_autoload_register("AutoLoad::loaded");


    // 测试
    (new \App\Test())->say();
    (new \App\Controllers\IndexController())->say();