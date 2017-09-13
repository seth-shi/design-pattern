<?php


/**
 * 观察者接口
 * Interface Observer
 */
interface Observer
{
    /**
     * 当被观察者状态发生改变时，通知观察者
     * @param Observed $bbserved
     * @return mixed
     */
    public function change(Observed $bbserved);
}

/**
 * 被观察者类接口类
 * Interface Observer
 */
interface Observed
{
    // 注册观察者
    public function attach(Observer $observer);
    // 删除观察者
    public function detach(Observer $observer);
    // 触发通知
    public function notify();
}



/**
 * 被观察者类
 * Class Observer
 */
class Server implements Observed
{
    // 现有的钱
    private $sala;
    // 观察者 map
    private $observer = [];

    /**
     * 注册一个观察者
     * @param Observer $observer
     */
    public function attach(Observer $observer)
    {
        // 如果没注册，就已经注册
        if (false === array_search($observer, $this->observer))
        {
            $this->observer[] = $observer;
        }
    }

    /**
     * 移除观察者
     * @param Observer $observer
     */
    public function detach(Observer $observer)
    {
        // 如果找到，就移除掉
        $key = array_search($observer, $this->observer);
        if (false !== $key)
        {
            unset($this->observer[$key]);
        }
    }

    /**
     * 触发通知
     */
    public function notify()
    {
        // 遍历通知观察者
        foreach ($this->observer as $observer)
        {
            $observer->change($this);
        }
    }


    public function setSala($sala)
    {
        $this->sala = $sala;

        // 通知观察者
        $this->notify();
    }

    public function getSala()
    {
        return $this->sala;
    }
}

/**
 * 邮件类
 * Class Mail
 */
class Mail implements Observer
{
    public function change(Observed $observed)
    {
        /**
         * 没钱了，发邮件，因为邮件是免费的
         */
        if ($observed->getSala() < 10000)
        {
            echo '我发邮件也能活着';
        }

    }
}

/**
 * 短信类
 * Class SMS
 */
Class SMS implements Observer
{
    public function change(Observed $observed)
    {
        /**
         * 如果工资大于 1w 就发短信
         */
        if ($observed->getSala() > 10000 && $observed->getSala() < 100000)
        {
            echo '钱多发短息';
        }


    }
}

/**
 * 彩信类
 * Class MMS
 */
class MMS  implements Observer
{
    public function change(Observed $observed)
    {
        /**
         * 钱太多，任性，发彩信
         */
        if ($observed->getSala() > 100000)
        {
            echo '钱太多，任性，发彩信';
        }

    }
}

// 被观察者
$server = new Server();

// 注册观察者
$server->attach(new Mail());
$server->attach(new SMS());
$server->attach(new MMS());

// 变更状态 -> 通知
$server->setSala(1000000);

// 变更状态 -> 通知
$server->setSala(99999);

// 变更状态 -> 通知
$server->setSala(9);

/********************************************************
 * 钱太多，任性，发彩信钱多发短息我发邮件也能活着
 */