<?php

/**
 *冒泡排序
 */

function bubbleSort($dataSort)
{
	$length = count($dataSort);

	for($i=0;$i<$length-1;$i++){
		for($j=0;$j<($length-$i-1);$j++){
			if($dataSort[$j]>$dataSort[$j+1]){
				$tmp = $dataSort[$j+1];
				$dataSort[$j+1] = $dataSort[$j];
				$dataSort[$j] = $tmp;
			}
		}
	}
	return $dataSort;
}


function bubbleSort1($dataSort)
{
	$length = count($dataSort);

	for($i=0;$i<$length-1;$i++){
		for($j=($length-1);$j>$i;$j--){
			if($dataSort[$j]<$dataSort[$j-1]){
				$tmp = $dataSort[$j-1];
				$dataSort[$j-1] = $dataSort[$j];
				$dataSort[$j] = $tmp;
			}
		}
	}
	return $dataSort;
}


function bubbleSort2($arr)
{
    $length = count($arr);

    for ($i = 0; $i < ($length - 1); $i ++) {
        for ($j = 0; $j < ($length - 1 -$i); $j++) {
            if ($arr[$j + 1] < $arr[$j]) {
                list($arr[$j + 1], $arr[$j]) = [$arr[$j], $arr[$j +1]];
            }
        }
    }
    return $arr;
}

$arr = [2,34,5,9,2341,23,-10,2,6,2,8];
$b = microtime();
 var_dump((bubbleSort2($arr)));die;
$c = microtime();
var_dump($b,'---'.$c);
function maopao($arr){
    $len = count($arr);
    for($k=0;$k<=$len;$k++)
    {
        for($j=$len-1;$j>$k;$j--){
            if($arr[$j]<$arr[$j-1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j-1];
                $arr[$j-1] = $temp;
            }
        }
    }
    return $arr;
}
$b = microtime();
 var_dump((maopao($arr)));
$c = microtime();
var_dump($b,'---'.$c);
