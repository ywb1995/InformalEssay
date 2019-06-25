<?php
/**
 * 观察者接口
 */
namespace OrderDemo\CommonInterface;

Interface ObserverInterface{
    /**
     * 每个观察者都要实现的方法 接收到通知的处理方法
     * User: YWB
     * Date: 2019/6/25 0025
     * Time: 16:03
     * @return mixed
     */
	public function update();
}