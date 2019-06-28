<?php
/**
 * 任务类
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/6/28 0028
 * Time: 17:42
 */

namespace App;

class Task {
    protected $taskId;
    protected $coroutine;
    protected $sendValue = null;
    protected $beforeFirstYield = true;

    /**
     * Task constructor.
     * @param $taskId 任务ID
     * @param \Generator $coroutine 任务实例 一个可迭代对象（也就是生成器）
     */
    public function __construct($taskId, \Generator $coroutine) {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }

    /**
     * 获取任务ID
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:47
     * @return 任务ID
     */
    public function getTaskId() {
        return $this->taskId;
    }

    /**
     * 设置发送给任务的值
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:47
     * @param $sendValue
     */
    public function setSendValue($sendValue) {
        $this->sendValue = $sendValue;
    }

    /**
     * 执行任务
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:48
     * @return mixed
     */
    public function run() {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $retval = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retval;
        }
    }

    /**
     * 任务是否已经结束
     * User: YWB
     * Date: 2019/6/28 0028
     * Time: 17:48
     * @return bool  true=完成 false=未完成
     */
    public function isFinished() {
        return !$this->coroutine->valid();
    }
}