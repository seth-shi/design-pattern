<?php

/**
 * 工厂类
 * Class Factory
 */
class Factory
{
    public static function make($class)
    {
        // 实际上这里需要更多的判断，比如命名空间之类的
        return new $class;
    }
}

/**
 * A 产品
 * Class A
 */
class A
{
}

/**
 * B 产品
 * Class B
 */
class B
{

}

/**
 * C 产品
 * Class C
 */
class C
{

}


$a = Factory::make('A');
$b = Factory::make('B');
$c = Factory::make('C');


var_dump($a, $b, $c);

/*****************************************
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class A#1 (0) {
}
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class B#2 (0) {
}
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class C#3 (0) {
}
 */