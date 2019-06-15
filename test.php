<?php
/**
 * 
 */
class Node{
    public $v;
    public $next;
    public function __construct($v)
    {
        $this->v = $v;
//        $this->next = $next;
    }

}


/**
 * 头插法
 * User: YWB
 * Date: 2019/6/15 0015
 * Time: 17:44
 * @param $n
 * @return Node|null
 */

function headInsert($n)
{
    $obj = null;
    for ($i = 0; $i < $n; $i++) {
        $tmp = new Node($i);
        if (is_null($obj)) {
            $obj = $tmp;
        } else {
            $tmp->next = $obj;
        }
        $obj = $tmp;

    }
    return $obj;
}


/**
 * 尾插法
 * User: YWB
 * Date: 2019/6/15 0015
 * Time: 17:44
 * @param $n
 * @return Node|null
 */
function tailInsert($n)
{
    $obj = null;
    for ($i = 0; $i < $n; $i++) {
        $tmp = new Node($i);
        if (is_null($obj)) {
            $obj = $tmp;
        } else {
            $next->next = $tmp;
        }
        $next = $tmp;
    }
    return $obj;
}

$a = test1(3);
print_r($a);



