<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/7/4 0004
 * Time: 13:50
 */

$arr = [1,2,3];
foreach($arr as &$v) {
    //nothing todo.
}


foreach($arr as $v) {
    //nothing todo.
}

var_export($arr);  //打印出 1 2 2


/**
 * 
 * 解析
 * 第一个foreach可以看成
 */

$v = &$arr[0];
$v = &$arr[1];
$v = &$arr[2];
//所以最后$v指向$arr[2]

/**
 * 第二个foreach可以看成
 */

$v = $arr[0];  //  $arr变成了1,2, 1
$v = $arr[1]; // $arr变成了 1,2,2
$v = $arr[2];//$arr 变成了 1, 2, 2