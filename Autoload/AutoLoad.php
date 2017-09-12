<?php
    
    class AutoLoad
    {
        /**
         * 带有命名空间的类名
         * @param $class
         */
        public static function loaded($class)
        {
            // 取出 命名空间
            $path = dirname($class);
            // 取出 类名
            $class = basename($class);

            // 命名空间全部小写
            $path = strtolower($path);

            // 在根目录下
            if ($path == '.')
            {
                $class = ROOT_PATH . '/' . $class . ".php";
            }
            else
            {
                // 拼接类名
                $class = ROOT_PATH . '/' . $path . '/' . $class . ".php";
            }


            // path 转换斜杆
            $class = str_replace("\\", "/", $class);


            if (is_file($class))
            {
                require $class;
            }

        }
    }