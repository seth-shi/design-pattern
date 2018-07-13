<?php

class Pipeline
{
    /**
     * @var array
     */
    protected $pipes;

    /**
     * 需要处理的内容
     *
     * @var string
     */
    protected $filter;

    public function __construct(string $filter)
    {
        $this->filter = $filter;
    }

    public function through(array $pipes) : Pipeline
    {
        $this->pipes = $pipes;

        return $this;
    }

    public function then()
    {
        /**
         * @param $last string 上一次处理的结果,第一次是 array_reduce 的第三个参数
         * @param $curr string 遍历 array_reduce 第一个参数的所有元素传入
         * @return string
         */
        $handle = function ($last, $curr) {
            /**
             * @var $object \Filters\FilterContract
             */
            $object = new $curr;
            return $object->handle($last);
        };

        return array_reduce($this->pipes, $handle, $this->filter);
    }

}
