<?php
//一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去…，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。

/**
*
**/
function randKing($n,$m){
	$monkeys = range(1, $n);
    $i=0;
    while (count($monkeys)>1) {
        if(($i+1)%$m==0) {
            unset($monkeys[$i]);
        } else {
            array_push($monkeys,$monkeys[$i]);
            unset($monkeys[$i]);
        }
        $i++;
    }
    return current($monkeys);
}

echo randKing(3,2);


function rangToOne1($n, $m)
{
    $arr = range(1, $n);

    $i = 1;
    while (count($arr) > 1) {
        if (($i%$m) == 0) {
            unset($arr[$i - 1]);
        } else {
            array_push($arr, $arr[$i - 1]);
            unset($arr[$i - 1]);
        }
        $i++;
    }
    return current($arr);
}
echo rangToOne1(3,2);


/**
 * 数组复制。[1,2,3], 复制一次， [1,2,3]。复制两次[1,2,3,1,2,3]
 * User: YWB
 * Date: 2019/7/5 0005
 * Time: 10:06
 * @param $arr
 * @param $j
 * @return array
 */
function arrClone($arr, $j)
{
    $tmp = $arr;
    for ($i = 0; $i < ($j - 1); $i++) {
        $arr = array_merge($arr, $tmp);
    }
    return $arr;
}

$aa = aa([1,2,3], 2);

var_dump($aa);

