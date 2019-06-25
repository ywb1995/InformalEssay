<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/25 0025
 * Time: 16:32
 */

require_once __DIR__.'/vendor/autoload.php';


//被观察者
$order = new \OrderDemo\Observable\Order();

//观察者
$email = new \OrderDemo\Observer\Email();
$Log = new \OrderDemo\Observer\Log();
$order->attach($email);
$order->attach($Log);

//下第一个订单
$order->addOrder();


//下第二个订单前删除邮件通知
$order->detach($email);
$order->addOrder();

var_dump($order);