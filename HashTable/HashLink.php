<?php

namespace HashTable;

/**
 * Class HashLink
 *
 * 这个类负责维护一条链表
 *
 * @package HashTable
 */
class HashLink
{
    /**
     * 当前存储元素的 key
     *
     * @var string|integer
     */
    public $key;

    /**
     * 当前存储元素的 value
     * @var mixed
     */
    public $value;

    /**
     * 链表的下一个指向
     *
     * @var static
     */
    public $next;

    public function __construct($key, $value, HashLink $next = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }
}
