<?php
$a =100;
echo $a-->2;die;
 http://www.zhihu.com
 //实现装饰器
 $dec=function($func) {
     $wrap=function ()use ($func) {
	     echo "before calling you do sth\r\n";
	     $func();
	     echo "after calling you can do sth too\r\n ";
     };
     return $wrap;
 };

 //执行某功能的函数
 $hello=function (){
     echo "hello\r\n";
 };
 //装饰
 $hello=$dec($hello);



 //在其他地方调用经过装饰的原函数
 $hello(); 

/*output:
before calling you do sth
hello
after calling you can do sth too
*/

$dec = function($func){
	$warp = function()use($func){
			echo '222';
			$func();
			echo '333';
	};
	return $warp;
};

$gongneng = function(){
	echo 222;
};

$a = $dec($gongneng);