<?php
function test()
{
	# code...
	$a = range(1, 10);
	return $a;
}

/**
*生成可迭代对象
*/
function test1($n , $x){

	while ($n<=$x) {
		# code...
		yield $n;
		$n = $n+1;
	}

}
$vv = test1(1,5);
foreach ($vv as $key => $value) {
	# code...
	var_dump($value);
}

//实际应用
//读取超大文件
function readBigText($filePath){
	$handle = fopen($filePath, 'r');

	while (feof($handle) === false) {
		# code...
		yield fgets($handle);
	}

	fclose($handle);
}


foreach (readBigText('../filehandle/bbe.txt') as $key => $value) {
	# code...
	var_dump($value);
}
