<?php

/**
 * 被观察者接口
 */
namespace OrderDemo\CommonInterface;

interface ObservableInterface{

    /**
     * 给被观察者增加观察者
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:05
     * @param ObserverInterface $observer 观察者对象
     * @return mixed
     */
	public function attach(ObserverInterface $observer);

    /**
     * 删除被观察者的某个观察者
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:06
     * @param ObserverInterface $observer 观察者对象
     * @return mixed
     */
    public function detach(ObserverInterface $observer);
    // 触发通知
    public function notify();
}