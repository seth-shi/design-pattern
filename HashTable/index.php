<?php

use HashTable\HashTable;


require __DIR__ . '/HashLink.php';
require __DIR__ . '/HashTable.php';

// 申请一个大小为 9 的数组
$hash = new HashTable(9);
$hash->set('name', 'david');
$hash->set('sex', 'man');
$hash->set('age', 21);
$hash->set('name', 'gps');

// gps, 后来的覆盖前面的值
$hash->get('name');

$hash->delete('name');
// NULL， 因为已经删除了
$hash->get('name');

