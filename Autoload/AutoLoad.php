<?php
    
class AutoLoad
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function loaded($class)
    {
        // 取出 命名空间
        $path = dirname($class);
        // 取出 类名
        $class = basename($class);

        // 命名空间全部小写
        $path = strtolower($path);

        $realClass = "{$this->basePath}/{$path}/{$class}.php";
        $realClass = realpath($realClass);

        // path 转换斜杆
        $realClass = str_replace("\\", "/", $realClass);

        require $realClass;
    }
}