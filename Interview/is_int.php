<?php

$a = 10;
$a = decbin($a); //返回一个二进制数的字符串
var_dump($a);
if(is_int($a)){
	echo 1;
}else{
	echo '2';
}