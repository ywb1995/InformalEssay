<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/25 0025
 * Time: 16:32
 */

require_once __DIR__.'/vendor/autoload.php';

$order = new \OrderDemo\Observable\Order();
$email = new \OrderDemo\Observer\Email();
$order->attach($email);
$order->detach($email);

$order->addOrder();
var_dump($order);