<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/25 0025
 * Time: 16:13
 */
namespace OrderDemo\Observable;

use OrderDemo\CommonInterface\ObservableInterface;
use OrderDemo\CommonInterface\ObserverInterface;

class Order implements ObservableInterface
{
    /**
     * 用来保存观察者
     * @var \SplObjectStorage|null
     */
    private $observers = null;

    public function __construct()
    {
        //SplObjectStorage 是一个内置的php对象。用来实现observer非常方便
        $this->observers = new \SplObjectStorage();
    }

    /**
     * 新增订单
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:46
     */
    public function addOrder()
    {
        echo '下单成功!'.PHP_EOL;
        $this->notify(); //调用观察者通知
    }

    /**
     * 增加观察者
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:26
     * @param ObserverInterface $observer
     * @return mixed|void
     */
    public function attach(ObserverInterface $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * 移除观察者
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:26
     * @param ObserverInterface $observer
     * @return mixed|void
     */
    public function detach(ObserverInterface $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * 发送通知
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:26
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            // 把本类对象传给观察者，以便观察者获取当前类对象的信息
            $observer->update($this);
        }
    }
}