<?php
/**
 * 任务调度器
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 17:48
 */

namespace App;


class Scheduler
{
    /**
     * 最大的任务ID
     * @var int
     */
    protected $maxTaskId = 0;

    /**
     * 任务的map
     * @var array
     */
    protected $taskMap = []; // taskId => task

    /**
     * 任务队列,要执行的任务放入这里面
     * @var \SplQueue
     */
    protected $taskQueue;

    public function __construct() {
        $this->taskQueue = new \SplQueue();
    }

    /**
     * 新增加一个任务
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:52
     * @param \Generator $coroutine
     * @return int
     */
    public function newTask(\Generator $coroutine) {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    /**
     * 将任务压入队列
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:50
     * @param Task $task
     */
    public function schedule(Task $task) {
        $this->taskQueue->enqueue($task);
    }

    /**
     * 执行调度器中的所有任务
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:51
     */
    public function run() {
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
}