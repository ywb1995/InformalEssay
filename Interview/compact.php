<?php
//compact()函数 和extract()函数
$a = 'aa';
$b = 'bb';
$c = 'cc';
$d = 'dd';
$e = compact('a','b','c','d');
var_dump($e);

$AS = "ASSAM";
$OR = "ORISSA";
$KR = "KERELA";
       
$stats = compact("AS", "OR", "KR"); //将字符串转化为数组变量
   
print_r($stats);


$extract = [
	'm' => 'mm',
	'k' => 'kk'
];
$bb = extract($extract); //将数组转换为变量
var_dump($bb);
var_dump($m);
var_dump($k);