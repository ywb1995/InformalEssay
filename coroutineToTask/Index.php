<?php

require_once __DIR__.'/vendor/autoload.php';


foreach (xRange(1, 100) as $num)
{
//    echo $num, "\n";
}

$range = xRange(1, 10);
var_dump($range); // object(Generator)#1
var_dump($range instanceof Iterator); // bool(true)
/*
 *
这也解释了为什么xrange叫做迭代生成器, 因为它返回一个迭代器, 而这个迭代器实现了Iterator接口.
调用迭代器的方法一次, 其中的代码运行一次.例如, 如果你调用$range->rewind(), 那么xrange()里的代码就会运行到控制流第一次出现yield的地方. 而函数内传递给yield语句的返回值可以通过$range->current()获取.
为了继续执行生成器中yield后的代码, 你就需要调用$range->next()方法. 这将再次启动生成器, 直到下一次yield语句出现. 因此,连续调用next()和current()方法, 你就能从生成器里获得所有的值, 直到再没有yield语句出现.
对xrange()来说, 这种情形出现在$i超过$end时. 在这中情况下, 控制流将到达函数的终点,因此将不执行任何代码.一旦这种情况发生,vaild()方法将返回假, 这时迭代结束.
 * */


/**
    *协程
    *协程的支持是在迭代生成器的基础上, 增加了可以回送数据给生成器的功能(调用者发送数据给被调用的生成器函数).
    *这就把生成器到调用者的单向通信转变为两者之间的双向通信.
    *传递数据的功能是通过迭代器的send()方法实现的. 下面的logger()协程是这种通信如何运行的例子：
*/
$filename = 'storage/a.txt';
$logger = logger($filename);

$logger->send('Foo');
$logger->send('bar');


//你可能已经注意到调用current()之前没有调用rewind().这是因为生成迭代对象的时候已经隐含地执行了rewind操作.
$gen = gen();
var_dump($gen->current());
$c = $gen->send('a');
var_dump($c);

$d = $gen->send('b');
var_dump($d);


$task1 = function (){
    for($i = 0; $i < 5; $i++) {
        echo "This is task 1 iteration $i.<br/> \n";
        yield;
    }
};

$task2 = function (){
    for($i = 0; $i < 5; $i++) {
        echo "This is task 2 iteration $i.<br/> \n";
        yield;
    }
};

$scheduler = new \App\Scheduler();
$scheduler->newTask($task1());
$scheduler->newTask($task2());
$scheduler->run();




