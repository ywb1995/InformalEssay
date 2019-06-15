<?php
//'A::Test'

// 2.类静态方法
class A
{
	public static function test($req,$resp)
	{
		echo "hello world".'--req='.$req.'--resp='.$resp.PHP_EOL;
	}
}


//3.函数
 
function test($req,$resp)
{
	echo "hello world".'--req='.$req.'--resp='.$resp.PHP_EOL;
}



// 4.对象方法
class B
{
	public function test($req,$resp)
	{
		echo "hello world".'--req='.$req.'--resp='.$resp.PHP_EOL;
	}
}


// A::test('a','b');

call_user_func(function($req,$resp)
	{
		echo "hello world".'--req='.$req.'--resp='.$resp.PHP_EOL;
	},'a','b');


call_user_func('A::test','a','b');

call_user_func_array('test', ['a','b']);

call_user_func_array([new B(),'test'], ['a','b']);

