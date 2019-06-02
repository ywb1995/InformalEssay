<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
try {
	a(1);
} catch (\Exception $e) {
	var_dump($e->getMessage());
}

// b();

function a($value='')
{
	echo '我是函数a';
	b();
}

function b(){
	c();
	echo '我是函数b';

}