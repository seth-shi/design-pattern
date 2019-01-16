<?php

class Node
{
    public $next;
    public $prev;

    public $val;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

class MyLinkedList {

    protected $length = 0;
    protected $head;
    protected $tail;

    /**
     * 初始化链表为只有一个元素
     *
     * @param $node
     */
    protected function initLink($node)
    {
        $this->head = $node;
        $this->tail = $node;

        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }

    /**
     * 遍历链表
     *
     * @param $index
     * @param $func
     * @return int
     */
    protected function mapLink($index, $func)
    {
        if (is_null($this->head)) {

            return -1;
        }


        $currNode = $this->head;
        $i = 0;
        while (true) {

            // 如果这个位置存在元素
            if ($i === $index) {

                return $func($currNode);
            }

            // 如果当前节点等于尾节点, 则可以退出
            if ($currNode === $this->tail) {

                break;
            }

            // 进入下一次循环
            ++ $i;
            $currNode = $currNode->next;
        }

        return -1;
    }

    /**
     * 取链表中第 index 个节点的值。
     * 如果索引无效，则返回-1。
     *
     * @param $index
     * @return int
     */
    public function get($index)
    {
        return $this->mapLink($index, function (Node $node) {

            return $node->val;
        });
    }

    /**
     * 在链表的第一个元素之前添加一个值为 val 的节点。插入后，
     * 新节点将成为链表的第一个节点。
     *
     * @param $val
     */
    public function addAtHead($val)
    {
        $node = new Node($val);

        ++ $this->length;

        // 如果头部为空
        if (is_null($this->head)) {

            $this->initLink($node);
            return;
        }

        // 让新节点和旧头结点连接起来
        $node->next = $this->head;
        $this->head->prev = $node;
        // 并把链表头指向新节点
        $this->head = $node;
    }


    /**
     * 将值为 val 的节点追加到链表的最后一个元素。
     *
     * @param $val
     */
    public function addAtTail($val)
    {
        $node = new Node($val);

        ++ $this->length;

        if (is_null($this->tail)) {

            $this->initLink($node);
            return;
        }

        // 让新节点和尾节点连接起来
        $node->prev = $this->tail;
        $this->tail->next = $node;
        // 并把链表尾指向新节点
        $this->tail = $node;
    }


    /**
     * 在链表中的第 index 个节点之前添加值为 val  的节点。
     * 如果 index 等于链表的长度，则该节点将附加到链表的末尾。
     * 如果 index 大于链表长度，则不会插入节点。
     *
     * @param $index
     * @param $val
     */
    public function addAtIndex($index, $val)
    {
        if ($index === 0) {

            $this->addAtHead($val);
            return;
        }

        if ($index === $this->length) {

            $this->addAtTail($val);
            return;
        }

        // 插入到中间节点
        $this->mapLink($index, function (Node $node) use ($val) {

            $newNode = new Node($val);


            $newNode->prev = $node->prev;
            $newNode->next = $node;
            $node->prev->next = $newNode;
            $node->prev = $newNode;

            ++ $this->length;
        });
    }

    /**
     * 如果索引 index 有效，则删除链表中的第 index 个节点。
     *
     * @param $index
     */
    public function deleteAtIndex($index)
    {

        // 插入到中间节点
        $this->mapLink($index, function (Node $node) {

            $node->prev->next = $node->next;
            $node->next->prev = $node->prev;

            $node = null;

            -- $this->length;
        });
    }
}


// 输入
// ["MyLinkedList","get","addAtIndex","get","get","addAtIndex","get","get"]
// [[],[0],[1,2],[0],[1],[0,1],[0],[1]]
$link = new MyLinkedList();
// -1
$link->get(0);
$link->addAtIndex(1, 2);
// -1
$link->get(0);
// -1
$link->get(1);
$link->addAtIndex(0, 1);
// 1
$link->get(0);
// -1
$link->get(1);
