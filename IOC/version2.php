<?php
/**
 * 超人版本2,拥有多个能力
 */



//----------构建能力类 start
class Flight
{
    protected $speed;
    protected $holdtime;
    public function __construct($speed, $holdtime)
    {

    }
}

class Force
{
    protected $force;
    public function __construct($force)
    {

    }
}

class Shot
{
    protected $atk;
    protected $range;
    protected $limit;
    public function __construct($atk, $range, $limit)
    {

    }
}
//----------构建能力类 end


class Superman
{
    protected $power;

    public function __construct()
{
    $this->power = new Fight(9, 100);
    // $this->power = new Force(45);
    // $this->power = new Shot(99, 50, 2);
    /*
    $this->power = array(
        new Force(45),
        new Shot(99, 50, 2)
    );
    */
}
}
