<?php

    header('Content-type: text/html; charset=utf-8');

    if (!isset($_GET['name']))
    {
        header('Location: http://baidu.com');
    }



    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379) or die('redis 服务未启动');

    $msg = "";
    $name = $_GET['name'];
    // 判断用户名是否存在  因为 hash 只能判断字段， 所以带上 哈希 名
    if (!$redis->hExists($name, 'name'))
    {
        $msg = "删除失败，用户 {$name} 不存在";
    }
    else
    {
        // 哈希名  字段名  字段值
        // 就用用户名做哈希名，不允许重复用户名
        if (1 === $redis->delete($name))
        {
            $msg = "删除成功";
        }
        else
        {
            $msg = "删除失败，请稍后再试";
        }
    }

    echo $msg;