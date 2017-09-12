<?php

    header('Content-Type: text/html; charset=utf-8');

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379) or die('redis 服务未启动');


    $users = $redis->keys('*');

    if (empty($users))
    {
        echo 0;

        exit();
    }


    $data = [];
    foreach ($users as $value) 
    {
        $data[] = $redis->hGetAll($value);
    }

    echo json_encode($data);