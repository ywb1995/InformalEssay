<?php
/**
 * 调度度类
 */
require_once 'Task.php';
require_once 'SystemCall.php';

class Scheduler
{
    /**
     * 任务队列
     * @var SplQueue
     */
    protected $taskQueue;

    /**
     * 最后一个任务的ID
     * @var int
     */
    protected $maxTaskId = 0;

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    /**
     * 新加生成器到任务
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 16:38
     * @param Generator $coroutine 生成器对象
     * @return int
     */
    public function newTask(Generator $coroutine)
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;

    }

    /**
     * 将任务发送加到调度队列
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 16:38
     * @param Task $task 任务对象
     */
    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }

    /**
     * 执行调度任务
     * User: YWB
     * Date: 2019/5/11 0011
     * Time: 16:39
     */
    public function run()
    {
        //当调度任务中不为空
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $retval = $task->run();

            if ($retval instanceof SystemCall) {
                $retval($task, $this);
                continue;
            }

            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }

    /**
     * 杀死一个任务
     * User: YWB
     * Date: 2019/5/13 0013
     * Time: 11:31
     * @param $tid
     * @return bool
     */
    public function killTask($tid)
    {
        if (!isset($this->taskMap[$tid])) {
            return false;
        }

        unset($this->taskMap[$tid]);

        // This is a bit ugly and could be optimized so it does not have to walk the queue,
        // but assuming that killing tasks is rather rare I won't bother with it now
        foreach ($this->taskQueue as $i => $task) {
            if ($task->getTaskId() === $tid) {
                unset($this->taskQueue[$i]);
                break;
            }
        }

        return true;
    }
}