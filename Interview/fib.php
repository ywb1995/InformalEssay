<?php

$json = [
    'a' => 1,
    'b' => 2,
    'c' => 3,
    'd' => 4
];
$json = json_encode($json);
$objs = json_decode($json);

echoObj($objs);

function echoObj($objs, $level = 0)
{
    foreach ($objs as $obj) {
        echo str_pad(' ', $level * 4);
        echo $obj->name."\n";
        if (!empty($obj->ch)) {
            $level++;
            echoObj($obj->ch, $level);
            $level--;
        }
    }
}
die;

/**
 * 实现斐波那契数列
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/7/5 0005
 * Time: 10:07
 */

function fib($n)
{
    if ($n <= 2) {
        return 1;
    }

    return fib($n -1) + fib($n - 2);
}

echo fib(3);