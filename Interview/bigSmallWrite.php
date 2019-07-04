<?php


//strtolower()和strtoupper()函数在安装非中文系统的服务器下可能会导致将汉字转换为乱码，请写两个替代的函数实现兼容Unicode文字的字符串大小写转换

//这个函数按照字节切割
$a = str_split('养文本',1);

function myStrToUpper($str){
	$arr = str_split($str,1);
	$resultStr = '';
	foreach ($arr as $value) {
		$ordValue = ord($value);
		//小写字母在 97 到122之间
		if($ordValue >= 97 && $ordValue <= 122){
			$ordValue -= 32;
		}
		$chrValue = chr($ordValue);
		$resultStr .= $chrValue; 
	}
	return $resultStr;
}

echo myStrToUpper('a中你继续F@#$%^&*(BMDJFDoalsdkfjasl');


function myStrToLower($str){
	$strArr = str_split($str);

	$resultStr = '';

	foreach ($strArr as $value) {
		#...
		$ordValue = ord($value);
		//大写字母在65到90
		if($ordValue >= 65 && $ordValue <= 90){
			$ordValue += 32;
		}
		$chrValue = chr($ordValue);
		$resultStr .= $chrValue;
	}
	return $resultStr;;
}

echo myStrToLower('a中你继续F@#$%^&*(BMDJFDoalsdkfjasl');


//判断文件或目录是否可以写
opendir('path');
fopen('aa');

