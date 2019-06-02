<?php

include 'SingleLinkList.php';
//链表反转

function ReverseList($pHead)
{
	if($pHead == null || $pHead->next == null){
		return $pHead;
	}

	//当前节点
	$currentNode = $pHead->next;
	//#前一节点 ，这里是根节点
	$lastNode = $pHead;
	$next = null;    #后一节点

	while ($currentNode) {
		# code...
		$next = $currentNode->next; //当前节点的下一节点
		$currentNode->next = $lastNode;

		//后移动
		$lastNode = $currentNode; 
		$currentNode = $next; 
	}
	return $lastNode;
}

$result = (new SingleLinkList)->headInsert(4);
print_r($result);
$result = ReverseList($result);
print_r($result);

select sum(price ) as s from orders where group by user_id order by s having s >1000
