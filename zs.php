<?php
//PHP的一些奇技淫巧


/**
 技巧1：在类外面调用私有的类
*/
class A
{
    private function doSomething($a)
    {
        echo 'to'.$a;
    }
}

$obj = new A();
(function ($a) {
    $this->doSomething($a);
})->bindTo($obj, $obj)(2);

//或者使用bind方法
$nf = function($a) {
    $this->doSomething($a);
};
$nf = Closure::bind($nf, $obj, $obj);
$nf(1);
// var_dump($a());
// die;


/**
* 技巧2：障眼法 其实就是a-- > 1
**/
$a =212;
echo $a-->1;

/**
* 技巧3：位移运算 
**/
$a =212;
echo $a>>2;die; //时间上就是  $a / (2^2);


//http://www.zhihu.com
/**
* 技巧3：实现装饰器
**/
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
