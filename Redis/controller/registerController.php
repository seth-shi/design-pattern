<?php

    header('Content-Type: text/html; charset=utf-8');

    $name = $_POST['user'];
    $pwd = $_POST['pwd'];
    $age = intval($_POST['age']);


    if ($name == "" || $pwd == "")
    {
        exit("用户名或者密码不能为空");
    }

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379) or die('redis 服务未启动');

    $msg = "";
    // 判断用户名是否存在  因为 hash 只能判断字段， 所以带上 哈希 名
    if ($redis->hExists($name, 'name'))
    {
        $msg = "用户 {$name} 已存在";
    }
    else
    {
        // 哈希名  字段名  字段值
        // 就用用户名做哈希名，不允许重复用户名
        $errno = 0;
        $errno += $redis->hSet($name, 'name', $name);
        $errno += $redis->hSet($name, 'pwd', $pwd);
        $errno += $redis->hSet($name, 'age', $age);

        if (3 === $errno)
        {
            $msg = "注册成功";
        }
        else
        {
            $msg = "注册失败，请稍后再试";
        }
    }

    

    echo $msg;