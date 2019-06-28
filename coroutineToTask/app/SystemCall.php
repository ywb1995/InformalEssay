<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 18:03
 */

namespace App;


class SystemCall
{
    protected $callback;

    public function __construct(callable $callback) {
        $this->callback = $callback;
    }

    public function __invoke(Task $task, Scheduler $scheduler) {
        $callback = $this->callback;
        return $callback($task, $scheduler);
    }
}