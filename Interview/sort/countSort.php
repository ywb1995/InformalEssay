<?php


function counting_sort($my_array, $min, $max)
{
    $count = array();
    for($i = $min; $i <= $max; $i++)
    {
        $count[$i] = 0;
    }
 	//[1,2,...8]  [1,3,]
    foreach($my_array as $number)
    {
        $count[$number]++;
    }
    $z = 0;
    for($i = $min; $i <= $max; $i++) {
        while( $count[$i]-- > 0 ) {
            $my_array[$z++] = $i;
        }
    }
    return $my_array;
}

function count_sort($arr , $min, $max){
	$count = [];
	//构建计数数组
	for($i=$min; $i<=$max; $i++){
		$count[$i] = 0;
	}

	//计数
	foreach ($arr as $key => $value) {
		$count[$value] ++;
	}
	 $z = 0;
    for($i = $min; $i <= $max; $i++) {
        while( $count[$i]-- > 0 ) {
            $arr[$z++] = $i;
        }
    }
    return $arr;
}

$test_array = array(3, 0, 2, 5, -1, 4, 1);
echo "原始数组 :\n";
echo implode(', ',$test_array );
echo "\n排序后数组\n:";
$aaa = count_sort($test_array, -1, 5);
var_dump($aaa);
echo implode(', ',count_sort($test_array, -1, 5)). PHP_EOL;