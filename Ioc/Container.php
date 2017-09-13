<?php

/**
 * 简单的容器
 * Class Container
 */
class Container
{
    // 存储绑定
    private $maps = [];


    /**
     * 绑定一个实例
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {

        /**
         * 实际的项目中很少会直接传一个实例
         * 在 laravel 中是通过闭包来实现按需加载
         * 这里为了简单理解，直接放入 binds 数组中
         *
         * 一般只会保存单例，其他的都是需要就实例一个出来
         * 现在不管是不是单例，都是一直保存的
         */
        $this->maps[$abstract] = $concrete;
    }

    /**
     * laravel 中使用 make 方法命名
     * 取得一个预期的实例
     * @param $abstract
     */
    public function get($abstract)
    {
        /**
         * 直接返回 maps 数组中的成员
         */
        return $this->maps[$abstract];
    }

    /**
     * 判断是否有这个实例
     * @param $abstract
     */
    public function has($abstract)
    {
        // 搜寻 maps 数组中是否已经绑定有实例
        if (array_key_exists($abstract, $this->maps))
        {
            return true;
        }

        return false;
    }


}