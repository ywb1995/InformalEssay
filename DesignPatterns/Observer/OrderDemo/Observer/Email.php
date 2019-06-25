<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/25 0025
 * Time: 16:09
 */
namespace OrderDemo\Observer;

use OrderDemo\CommonInterface\ObserverInterface;

class Email implements ObserverInterface
{
    public function update()
    {
        echo '发送邮件通知！'.PHP_EOL;
    }
}