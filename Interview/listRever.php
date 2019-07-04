<?php



include 'SingleLinkList.php';
//链表反转

function ReverseList($pHead)
{
    if($pHead == null || $pHead->next == null){
        return $pHead;
    }
    $p = $pHead;
    $q = $pHead->next;
    $pHead->next = null;//$pHead 变为尾指针
    while($q){
        $r = $q->next;

        $q->next = $p;

        $p = $q;
        $q = $r;
    }
    return $p;

}


/**
 * 翻转单链表思路：
 * 1：获取头节点，并且将其next置为null。（尾节点的next为null）。同时为了保存剩下的节点信息。用$next(下一节点)存储下来
 * 2:循环的将获取的头结点赋值给下一节点（$next）的下一节点($next->next),这时的$next就是排序好的链表
 * 3:由于要将头节点赋值给$next->next，所以先用临时变量保存$next->next；记作$r
 * 4:将排序号的链表（$next）赋值给$head（也就是新的头节点）给下次循环使用
 * 5:返回$head
 * User: YWB
 * Date: 2019/7/3 0003
 * Time: 14:28
 * @param $nodeList
 * @return mixed
 */
function reverseList1($list)
{
    if ($list == null || $list->next == null) {
        return $list;
    }

    $next = $list->next;
    $list->next = null;
    while ($next) {
        $r = $next->next;
        $next->next = $list;
        $list = $next;
        $next = $r;
    }

    return $list;
}

$result = (new SingleLinkList)->headInsert(5);
print_r($result);
$result = reverseList1($result);
print_r($result);

