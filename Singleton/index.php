<?php


class Singleton
{
    /**
     * 必须定义有一个静态属性保存实例
     * 通常用 $instance 见名知意
     * @var
     */
    private static $instance;


    /**
     * 获取实例
     */
    public static function getInstance()
    {
        // 如果还没有保存有实例（第一次运行的时候），则去创建， 否则直接返回实例
        if (is_null(self::$instance))
        {
            // 实例化自身保存到静态变量中
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 构造方法必须是私有的，不允许外部调用生成新对象
     * Singleton constructor.
     */
    private function __construct(){}

    /**
     * 克隆方法私有，不允许外部克隆生成新对象
     */
    private function __clone(){}

    /**
     * 反序列化私有，不允许外部反序列生成新对象
     */
    private function __wakeup(){}

}


// 获取单例
$single1 = Singleton::getInstance();
$single2 = Singleton::getInstance();

/*****************************************
F:\phpStudy\WWW\designPattern\Singleton\index.php:60:
class Singleton#1 (0) {
}
F:\phpStudy\WWW\designPattern\Singleton\index.php:60:
class Singleton#1 (0) {
}
 */
var_dump($single1, $single2);