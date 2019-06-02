<?php
function quick_sort($my_array)
{
    if(count($my_array) < 2){
    	return $my_array;
    }

//    $first_key = key($my_array);
    $first_value = array_shift($my_array); //删除数组第一个元素

    $left = [];
    $right = [];
    foreach ($my_array as $key => $value) {
    	# code...
    	if($value <= $first_value ){
    		$left[] = $value;
    	}else{
    		$right[] = $value;
    	}
    }

    return array_merge(quick_sort($left),[$first_value],quick_sort($right));
}


$my_array = array(3, 0, 2, 5, -1, 4, 1);
echo '原始数组 : '.implode(',',$my_array).'\n';
$my_array = quick_sort($my_array);
echo '排序后数组 : '.implode(',',$my_array);

