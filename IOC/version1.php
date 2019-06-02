<?php
/**
 * 最老的版本,
 */




/**
 * 能力类
 * Class Power
 */
class Power
{
    /**
     * 能力值
     */
    protected $ability;

    /**
     * 能力范围或距离
     */
    protected $range;

    public function __construct($ability, $range)
    {
        $this->ability = $ability;
        $this->range = $range;
    }
}

/**
 * 超人类
 * Class Superman
 */
class Superman
{
    protected $power;

    public function __construct()
    {
        $this->power = new Power(999, 100);
    }
}

$supMan = new Superman(); //得到一个超人