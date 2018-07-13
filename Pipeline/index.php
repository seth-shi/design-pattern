<?php

require __DIR__ . '/../Autoload/AutoLoad.php';

// 注册加载类
spl_autoload_register([
                          new AutoLoad(__DIR__),
                          'loaded'
                      ]);


$filterString = 'Abcdnasdfjkla132afsd';


$filters = [
    \Filters\TrimA::class,
    \Filters\TrimB::class,
    \Filters\TrimC::class,
    \Filters\TrimString::class
];


$pipeline = new Pipeline($filterString);
$filterString = $pipeline->through($filters)
                         ->then();

var_dump($filterString);
