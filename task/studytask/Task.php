<?php
/**
 * 简单封装的任务类
 */
class Task  
{
    /**
     * 任务ID
     * @var
     */
    protected $taskId;

    /**
     * 任务执行
     * @var
     */
    protected $coroutine;

    /**
     * 发送给任务的值
     * @var
     */
    protected $sendValue;

    /**
     *
     function gen() {
        yield 'foo';
        yield 'bar';
     }

    $gen = gen();
    var_dump($gen->send('something'));

    如之前提到的在send之前, 当$gen迭代器被创建的时候一个rewind()方法已经被隐式调用
    所以实际上发生的应该类似:
    $gen->rewind();
    var_dump($gen->send('something'));

    这样renwind的执行将会导致第一个yield被执行, 并且忽略了他的返回值.
    真正当我们调用yield的时候, 我们得到的是第二个yield的值! 导致第一个yield的值被忽略.
    string(3) "bar"

     * 综上,所以设置一个判断是否需要第一次返回结果
     * @var bool
     */
    protected $beforeFirstYield = true;

    /**
     * 赋值任务ID 和任务内容
     * Task constructor.
     * @param int $taskId 任务ID
     * @param Generator $coroutine 任务内容
     */
	public function __construct($taskId, Generator $coroutine)
	{
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
	}

    /**
     * 获取任务ID
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 14:48
     * @return int
     */
	public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * 设置任务的值
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 14:54
     * @param $value
     */
    public function setSendValue($value)
    {
        $this->sendValue = $value;
    }

    /**
     * 是否执行完毕
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 14:55
     */
    public function isFinished()
    {
        //检查迭代器是否被关闭 迭代器已被关闭返回 FALSE，否则返回 TRUE。
        return !$this->coroutine->valid();
    }

    /**
     * 执行迭代器
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 15:03
     * @return mixed
     */
    public function run()
    {
        if ($this->beforeFirstYield) {

            $this->beforeFirstYield = false;
            return $this->coroutine->current();

        } else {

            $retVal = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retVal;
        }
    }
}