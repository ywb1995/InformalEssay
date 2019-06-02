<?php
//合并数组的方法

$arr1 = [
	'a' => 'this is a',
	'b' => 'this is b',
];
$arr2 = [
	'a' => 'this is c',
	'd' => 'this is d'
];

#1
$k = array_merge($arr1,$arr2); //后面的覆盖前面的a
var_dump($k);

#2  array_merge_recursive 合并两个数组，如果数组中有完全一样的数据，将它们递归合并

$a = array_merge_recursive($arr1,$arr2);  //this is a 和this is c 都合并到了'a' 下面
var_dump($a); 

#3
$b = $arr1+$arr2; //前面的a覆盖后面的a
var_dump($b);

#4
$z = array_combine ($arr1,$arr2); //前者的值成为后者的键
var_dump($z);



