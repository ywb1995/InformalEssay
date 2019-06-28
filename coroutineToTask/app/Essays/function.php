<?php

/**
 * 一些杂记函数
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 16:42
 */


/**
 * 迭代生成器
 * 这个xrange()函数提供了和PHP的内建函数range()一样的功能.但是不同的是range()函数返回的是一个包含值从1到100万0的数组(注：请查看手册).
 * 而xrange()函数返回的是依次输出这些值的一个迭代器, 而不会真正以数组形式返回.这种方法的优点是显而易见的.它可以让你在处理大数据集合的时候不用一次性的加载到内存中.
 * 甚至你可以处理无限大的数据流.
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 16:45
 * @param $start
 * @param $end
 * @param int $step
 * @return Generator
 */
function xRange($start, $end, $step = 1)
{
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

/**
 *协程的支持是在迭代生成器的基础上, 增加了可以回送数据给生成器的功能，实现调用者和被调用方法双向通信
 * 这个例子里yield关键字用来接收数据
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 16:55
 * @param $filename
 */
function logger($filename)
{
    $fileHandle = fopen($filename, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}

/**
 * 这个例子实现了yield关键字接收和发送数据
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 17:15
 */
function gen() {
    $ret = (yield 'yield1'); //$ret 会接收send方法的参数 而不是yield1，如果没有传参则是null
    var_dump($ret);
    $ret = (yield 'yield2'); //$ret 会接收send方法的参数 而不是yield2
    var_dump($ret);
}


function getTaskId() {
    return new App\SystemCall(function(App\Task $task, App\Scheduler $scheduler) {
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function task($max) {
    $tid = (yield getTaskId()); // <-- here's the syscall!
    for ($i = 1; $i <= $max; ++$i) {
        echo "This is task $tid iteration $i.\n";
        yield;
    }
}

