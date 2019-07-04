<?php

// putenv(setting)
//获取环境变量echo getenv("PATH"); 

//选择排序
function selectSort($arr)
{
	$length = count($arr);
	
	for($i=0; $i<($length-1);$i++){
		$min_key = $i;
		for($j=($i+1); $j<($length);$j++){
			if($arr[$j] < $arr[$min_key] ){
				$min_key = $j;
			}
		}

		if($i != $min_key ){
			$tmp = $arr[$i];
			$arr[$i] = $arr[$min_key];
			$arr[$min_key] = $tmp;
		}

	}
	return $arr;
}



function selectSort1($arr)
{
    $length = count($arr);


    for ($i = 0; $i < ($length - 1); $i++) {
        $minKey = $i;

        for ($j = ($i + 1); $j < ($length); $j++) {
            if ($arr[$j] < $arr[$minKey]) {
                $minKey = $j;
            }
        }

        if ($minKey != $i) {
            list($arr[$i], $arr[$minKey]) = [$arr[$minKey], $arr[$i]];
        }
    }

    return $arr;
}

$my_array = array(3, 0, 2, 5, -1, 4, 1);
echo "原始数组:\n";
echo implode(', ',$my_array );
echo "\n排序后数组:\n";
echo implode(', ' , selectSort($my_array)). PHP_EOL;

$my_array = array(3, 0, 2, 5, -1, 4, 1, -20);
$my_array = selectSort1($my_array);
var_dump($my_array);