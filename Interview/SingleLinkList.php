<?php

/**
 *  PHP 单链表
 *  time  :2017-8-14
 */


/**
 * TODO:构建链表节点
 */
Class Node{
    public $data;
    public $next;

    public function __construct($val,$nex){
        $this->data = $val;
        $this->next = $nex;
    }
}


/**
 * TODO:构建单链表 
 */
Class SingleLinkList{

    /*    头插法创建链表 n为节点总数    */
    public function headInsert($n){

        $head = NULL;
        for($i=$n;$i>0;$i--){
            $headN = new Node($i,$head);
            $head = $headN;
        }
        return $head;
    }

    /*    尾插法创建链表    */
    public function rearInsert($n){
        $head = null;
        for($i=1;$i<=$n;$i++){
            $headN = new Node($i,null);
            
            if( $head == null){
                $head = $headN;
            }else{
                while ($head->next !== null) {
                    $head = $head->next ;
                    

                }
                
            }

           

        }
        return $head;
    }


    /**
     * TODO:读取链表中第i个数据
     * @param $list object 待插入的链表
     * @param $i     int     节点序号
     */

    public function readIThNode($list,$i){
        /*    如果链表为空或者i小等于0    */
        if($list == null || $i<=0){
            echo "输入参数不合法";
            return ;
        }
        /*        */
        $p = $list->next;    #设置p指向第一个节点（即头节点的后继节点））
        $j=0;                #计时器必须初始化
        while($p && $j<$i ){
            $p = $p->next;
            ++$j;
        }

        /*    第i步    */
        if($p == null){    #说明链表已经结束，不存在i节点,过滤掉i大于链表长度的情况（因为节点是散列的，事先并不知道其长度）
            echo "i长度大于链表长度" ;
            exit;
        }else{
            $e = $p->data;    #第i个节点存在 ，返回
            return $e;
        }

    }

    /**
     * TODO:在链表的第i个位置之前插入节点e
     * @param $list object 待插入的链表
     * @param $i     int     节点序号
     * @param $e    object 待插入的节点
     */
    public function Insert($list,$i,$e){
        if($e == null){
            echo "待插入节点为空";
            exit;
        }
        $p = $list->next;    #设置p指向第一个节点
        $j=0;                #计时器必须初始化

        while($p && $j<$i ){
            $p = $p->next;    #保证节点在向后移动
            ++$j;
        }

        /*    第i步    */
        if($p == null){    #说明链表已经结束，不存在i节点,过滤掉i大于链表长度的情况（因为节点是散列的，事先并不知道其长度）
            echo "不存在i节点" ;
            exit;
        }else{
            /*    标准的插入语句（头插法）    */
            $e->next = $p->next;
            $p->next = $e;
            return $list;
        }
    }


    /**
     * TODO:删除链表的第i个节点，并返回该节点的值
     * @param $list object 待插入的链表
     * @param $i    int    节点序号
     */
    public function Delete($list,$i){
        if($list == null || $i<=0){
            echo "输入参数不合法";
            exit;
        }
        $p = $list->next;    #设置p指向第一个节点
        $j=0;                #计时器必须初始化

        while($p && $j<$i ){
            $p = $p->next;    #保证节点在向后移动
            ++$j;
        }

        /*    第i步    */
        if($p == null){    #说明链表已经结束，不存在i节点,过滤掉i大于链表长度的情况，以为若i大于链表长度，则上面循环会跳出直接进入判断然后返回
            echo "不存在i节点" ;
            exit;
        }else{
            /*    标准的删除语句    */
            $q = $p->next;
            $p->next = $q->next;
            $e = $q->data;
            unset($q);
            return $e;
        }
    }

    /**
     * TODO:删除整张链表
     * @param $list object 待插入的链表
     */
    public function DeleteAll($list){
        if($list == null ){
            echo "输入参数不合法";
            exit;
        }
        $p = $list->next;    #设置p指向第一个节点
        
        while($p != null ){
            $q = $p->next;    #保证节点在向后移动
            unset($p);
            $p = $q;
        }
    }

    /**
     * Question1:输出倒数第K个节点
     * @param $head object 链表
     * @param $k     int    序号
     */
    function FindKthToTail($head, $k){
        /*    如果链表为空或者k不合法 返回null    */
        if($head == null || $k<=0){
            return null;
        }
        
        /*    这里采用了复杂度为O(n)的算法，需要准备两个节点    */
        $behind = $head;    #指向链表的第一个节点
       
        /*    算法思路：准备两个指针，假如第一个指针走到n-1（即链表末尾），第二个指针走到倒数k的位置，两者之间相差(n-1)-(n-k) = k-1 */
        for($i=0;$i<$k-1;$i++){
            /*    让第一个指针先走k-1个单位，如果不为空，则指针向后移动    */
            /*    注意：这里有一个隐藏的条件，就是链表的长度有可能小于k，我们不不遍历完整个链表是无法知道其长度的    */
            if($head->next != null){
                $head = $head->next;
            }else{
                return ;
            }
        }
        /*    当第一个指针走到k-1且还不为空，这时让第二个指针开始走，当第一个指针走到n-1的时候，第二个指针也走到了倒数第k的位置，即所求    */
        while($head->next != null){
            $head = $head->next;
            $behind = $behind->next;
        }
        return $behind;
    }

    
    /**
     * Question2:反转链表
     * @param $head object 链表
     */
    public function ReverseList($pHead)
{
    /*    如果链表为空，返回null    */
    if($pHead == null){
        return null;
    }
    $pre  = $pHead; #前一节点 ，这里是根节点
    $cur  = $pre->next; #当前节点    2     例：1->2->3
    $next = null;    #后一节点
   
    /*    链表存在且不为空    */
    while(!$cur){
        $next = $cur->next;    #用一个变量暂时存储后一节点，因为一旦前面反转，就断链了
        $cur->next = $pre;    #将前一节点作为当前节点的后一节点，是为反转

        #指针后移
        $pre = $cur;    
        $cur = $next;   
    }
    return $pre;
}
}
