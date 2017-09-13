<?php


/**
 * 数据库操作对象接口
 */
interface DataBaseInterface
{
    // 所有数据库查询类都要实现查询方法（规定，你也可以规定其他方法）
    public function query();
}


/**
 * 操作 MySQL 数据库
 */
class MysqlDataBase implements DataBaseInterface
{
    public function __construct($dsn, $user, $pwd){}
    public function query()
    {
        echo '正在执行 Mysql 查询';
    }
}


/**
 * 操作 Redis 数据库
 */
class RedisDataBase implements DataBaseInterface
{
    public function __construct($host, $port){}
    public function query()
    {
        echo '正在执行 Redis 查询';
    }
}


/**
 * 操作 Memcache 数据库
 */
class MemcacheDataBase implements DataBaseInterface
{
    public function __construct($host, $port){}
    public function query()
    {
        echo '正在执行 Memcache 查询';
    }
}


/**
 * 数据库操作类
 */
class DB
{
    // 数据库句柄
    private $dbh;

    public function __construct(DataBaseInterface $dbh)
    {
        $this->dbh = $dbh;
    }

    // 查询数据
    public function query()
    {
        return $this->dbh->query();
    }
}

// 实例化一个 Mysql 类做为参数
$dbh = new MysqlDataBase('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
// 注入一个 Mysql 类
(new DB($dbh))->query();

// 注入一个 Redis 类
$dbh = new RedisDataBase('127.0.0.1', '6379');
(new DB($dbh))->query();

// 注入一个 Memcache 类
$dbh = new MemcacheDataBase('127.0.0.1', '11211');
(new DB($dbh))->query();

/****************** debug **********************

 正在执行 Mysql 查询正在执行 Redis 查询正在执行 Memcache 查询

 */