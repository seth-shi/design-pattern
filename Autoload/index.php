<?php

    // 引入自动加载文件
    require __DIR__. '/AutoLoad.php';
    // 注册加载类
    spl_autoload_register([
        new AutoLoad(__DIR__),
        'loaded'
    ]);


    // 测试
    (new \App\Test())->say();
    (new \App\Controllers\IndexController())->say();
