<?php

namespace HashTable;

use Exception;/**
 * Class HashTable
 * 此类负责维护哈希表
 *
 * @package HashTable
 */
class HashTable
{
    /**
     * 初始化申请数组块大小
     *
     * @var int
     */
    protected $maxKey;

    /**
     * 哈希表中的存储区
     *
     * @var HashLink[]
     */
    protected $data;


    /**
     * 设置一次申请的数组元素大小
     * 并初始化一个给定大小的数组
     *
     * @param int $maxKey
     */
    public function __construct($maxKey = 9)
    {
        $this->maxKey = $maxKey;

        $this->data = array_fill(0, $maxKey, null);
    }

    /**
     * 设置一个值进入哈希表
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        $hashKey = $this->hashKey($key);

        // 构造函数初始化了一个全部为 null 的数组
        // 当数组的这个元素第一次使用时，那么解决哈希冲突的链表的 next 也为 null
        if (is_null($this->data[$hashKey])) {

            $this->data[$hashKey] = new HashLink($key, $value);

            return true;
        }

        // 如果不是第一次设置，
        // 我们需要先判断节点中是不是已经保存了这个 key
        // 如果已经存在了这个 key，则覆盖
        $link = $this->data[$hashKey];
        while (! is_null($link)) {

            if ($link->key === $key) {

                $link->value = $value;

                return true;
            }

            $link = $link->next;
        }

        // 如果既不是第一次使用，哈希表中也没有保存这个 key
        // 那么就把新链表的 next 指向原来已经存在的链表
        $this->data[$hashKey] = new HashLink($key, $value, $this->data[$hashKey]);

        return true;
    }


    /**
     * 获取链表中保存的值，如果没有这个 key 返回 null
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        $hashKey = $this->hashKey($key);

        if (is_null($this->data[$hashKey])) {
            return null;
        }

        /**
         * 先取到数组的链表中的值
         *
         * @var $link HashLink
         */
        $link = $this->data[$hashKey];

        // 遍历整条链表
        while (! is_null($link)) {

            if ($link->key === $key) {
                return $link->value;
            }

            $link = $link->next;
        }

        return null;
    }


    /**
     * @param $key
     * @return null
     */
    public function delete($key)
    {
        $hashKey = $this->hashKey($key);

        if (is_null($this->data[$hashKey])) {
            return true;
        }

        /**
         * 慢链表，也是我们直接操作的链表
         *
         * @var $head HashLink
         */
        $head = $this->data[$hashKey];

        // 如果头结点就是的话，直接处理
        if ($head->key === $key) {

            $this->data[$hashKey] = $head->next;

            return true;
        }

        // 使用一个慢指针
        $slowNode = $head;
        // 头指针先走一步
        $head = $head->next;

        while (! is_null($slowNode->next)) {

            // 如果存在这个 key
            if ($head->key === $key) {

                // 取到慢节点的 next 等于 head 的 next，
                $slowNode->next = $head->next;

                return true;
            }



            // 头指针总是比慢指针先走一步
            $head = $slowNode->next->next;
            $slowNode = $slowNode->next;
        }

        return true;
    }


    /**
     * 根据给定最大的数组元素下标，
     * hash 一个 key
     *
     * @param $key
     * @return int
     */
    protected function hashKey($key)
    {
        $index = 0;

        if (is_string($key)) {

            for ($i = 0, $l = strlen($key); $i < $l; ++ $i) {
                $index += ord($key{$i});
            }
        } else {
            $index = intval($key);
        }

        return $index % $this->maxKey;
    }
}
