<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */


class ListNode {

     public $val = 0;
     public $next = null;

     function __construct($val)
     {
         $this->val = $val;
     }
}
class Solution
{
    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $obj = null;

        $additional = 0;
        do {
            $value = $l1->val + $l2->val + $additional;
            if ($value < 10) {
                $additional = 0;
            } else {
                $value -= 10;
                $additional = 1;
            }

            $tmp_obj = new ListNode($value);

            if (is_null($obj)) {
                $obj = $tmp_obj;
            } else {
                $next->next = $tmp_obj;
            }
            $next = $tmp_obj;

            $l1 = $l1->next;
            $l2 = $l2->next;

        } while ($l1 || $l2 || $additional);

        return $obj;
    }
}


$node2 = new ListNode(2);
$node4 = new ListNode(4);
$node3 = new ListNode(3);
$node4->next = $node3;
$node2->next = $node4;

print_r($node2);

$node5 = new ListNode(5);
$node6 = new ListNode(6);
$node4 = new ListNode(4);

$node6->next = $node4;
$node5->next = $node6;
print_r($node5);

$aa = (new Solution())->addTwoNumbers($node2,$node5);
print_r($aa);
