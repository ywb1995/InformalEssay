<?php
include_once 'task.php';

class Scheduler 
{
    protected $maxTaskId = 0;
    protected $taskMap = []; // taskId => task
    protected $taskQueue;
 
    public function __construct() 
    {
        $this->taskQueue = new SplQueue();
    }
 
    public function newTask(Generator $coroutine) 
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }
 
    public function schedule(Task $task) 
    {
        $this->taskQueue->enqueue($task);
    }
 
    public function run() 
    {
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $task->run();
 
            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }
}
// new Task();
// new Scheduler();

function task1() {
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}
 
function task2() {
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}
 
$scheduler = new Scheduler;
 
$scheduler->newTask(task1());
$scheduler->newTask(task2());
 
$scheduler->run();