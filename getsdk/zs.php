<?php

// http://www.zhihu.com


/*output:
before calling you do sth
hello
after calling you can do sth too
*/

$dec = function($func){
	$warp =function ()use ($func) {
			echo '222';
			$func();
			echo '333';
	};
};

$gongneng = function(){
	echo 222;
};

$a = $dec($gongneng);