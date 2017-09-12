<?php

    namespace Waitmoonman\Reflex;

    use Exception;
    use ReflectionClass;
    use ReflectionMethod;

    class Application
    {

        /*
         * 动态实例化对象
         * @param $class
         * @param array $parameters
         * @return mixed
         * @throws Exception
         */
        public static function make($class, $parameters = [])
        {
            // 通过反射获取反射类
            $rel_class = new ReflectionClass($class);

            // 查看是否可以实例化
            if (! $rel_class->isInstantiable())
            {
                throw new Exception($class . ' 类不可实例化');
            }

            // 查看是否用构造函数
            $rel_method = $rel_class->getConstructor();

            // 没有构造函数的话，就可以直接 new 本类型了
            if (is_null($rel_method))
            {
                return new $class();
            }

            // 有构造函数的话就获取构造函数的参数
            $dependencies = $rel_method->getParameters();

            // 处理，把传入的索引数组变成关联数组， 键为函数参数的名字
            foreach ($parameters as $key => $value)
            {
                if (is_numeric($key))
                {
                    // 删除索引数组， 只留下关联数组
                    unset($parameters[$key]);

                    // 用参数的名字做为键
                    $parameters[$dependencies[$key]->name] = $value;
                }
            }

            // 处理依赖关系
            $actual_parameters = [];

            foreach ($dependencies as $dependenci)
            {
                // 获取对象名字，如果不是对象返回 null
                $class_name = $dependenci->getClass();
                // 获取变量的名字
                $var_name = $dependenci->getName();

                // 如果是对象， 则递归new
                if (array_key_exists($var_name, $parameters))
                {
                    $actual_parameters[] = $parameters[$var_name];
                }
                elseif (is_null($class_name))
                {
                    // null 则不是对象，看有没有默认值， 如果没有就要抛出异常
                    if (! $dependenci->isDefaultValueAvailable())
                    {
                        throw new Exception($var_name . ' 参数没有默认值');
                    }

                    $actual_parameters[] = $dependenci->getDefaultValue();
                }
                else
                {
                    $actual_parameters[] = self::make($class_name->getName());
                }

            }


            // 获得构造函数的数组之后就可以实例化了
            return $rel_class->newInstanceArgs($actual_parameters);
        }


        /**
         * 动态运行对象的函数
         * @param $class
         * @param $method
         */
        public static function run($class, $method, $class_parameters = [], $method_parameters = [])
        {
            $object = self::make($class, $class_parameters);

            // 动态获取一个方法的参数
            $rel_method = new ReflectionMethod($object, $method);


            // 获取方法所需的参数
            $dependencies = $rel_method->getParameters();

            // 处理，把传入的索引数组变成关联数组， 键为函数参数的名字
            foreach ($method_parameters as $key => $value)
            {
                if (is_numeric($key))
                {
                    // 删除索引数组， 只留下关联数组
                    unset($method_parameters[$key]);

                    // 用参数的名字做为键
                    $method_parameters[$dependencies[$key]->name] = $value;
                }
            }

            // 处理依赖关系
            $actual_parameters = [];

            foreach ($dependencies as $dependenci)
            {
                // 获取对象名字，如果不是对象返回 null
                $class_name = $dependenci->getClass();
                // 获取变量的名字
                $var_name = $dependenci->getName();

                // 如果是对象， 则递归new
                if (array_key_exists($var_name, $method_parameters))
                {
                    $actual_parameters[] = $method_parameters[$var_name];
                }
                elseif (is_null($class_name))
                {
                    // null 则不是对象，看有没有默认值， 如果没有就要抛出异常
                    if (! $dependenci->isDefaultValueAvailable())
                    {
                        throw new Exception($var_name . ' 参数没有默认值');
                    }

                    $actual_parameters[] = $dependenci->getDefaultValue();
                }
                else
                {
                    $actual_parameters[] = self::make($class_name->getName());
                }

            }


            // 运行方法
            return $rel_method->invokeArgs($object, $actual_parameters);
        }

    }