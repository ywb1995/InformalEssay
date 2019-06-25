<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/25 0025
 * Time: 16:52
 */

namespace OrderDemo\Observer;


use OrderDemo\CommonInterface\ObserverInterface;

class Log implements ObserverInterface
{
    public function update()
    {
        echo '写入日志'.PHP_EOL;
    }
}