<?php

//插入排序

function insertSort_a($my_array)
{
	for($i=1; $i<count($my_array); $i++){
        $val = $my_array[$i]; //取出第一值
        $j = $i-1; //和前面的相比较

        //$j之前的是一个排序好的数组
        while($j>=0 && $my_array[$j] > $val){
            $my_array[$j+1] = $my_array[$j]; //将$j之前的位置后移，空出一个位置
            $j--;
        }

        $my_array[$j+1] = $val;
    }
    return $my_array;
}


function insertSort($my_array){

    $length = count($my_array);
    for ($i = 1; $i<$length; $i++){
        //取出当前需要比较的书
        $val = $my_array[$i];
        //和之前排序好的数组比较
        for ($j = $i - 1; $j>=0; $j--){
            if($my_array[$j] < $val){
                $my_array[$j+1] = $my_array[$j];
            }else{
                break;
            }
        }

        $my_array[$j+1] = $val;
    }

    return $my_array;
}

function insertSort1($arr)
{
    $length = count($arr);
    if ($length <= 1) {
        return $arr;
    }
    for ($i = 1; $i < $length; $i++) {
        $val = $arr[$i];
        $j = $i - 1;

        while ($j >=0 && $val > $arr[$j]) {
            $arr[$j +1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $val;
    }
}

$test_array = array(3, 0, 2, 5, -1, 4, 1);
echo "原始数组:\n";
echo implode(', ',$test_array );
echo "\n排序后数组 :\n";
print_r(insertSort($test_array));

print_r(insertSort1($test_array));