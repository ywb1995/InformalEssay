<?php
/**
 *
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/7/4 0004
 * Time: 13:56
 */

/**
 * 二分查找
 * User: YWB
 * Date: 2019/7/4 0004
 * Time: 17:56
 * @param array $arr  从小大到的数组
 * @param int|string $search 搜索值
 * @return bool
 */
function binarySearch($arr, $search)
{
    if (!is_array($arr) || empty($arr)) {
        return false;
    }
    $length = count($arr);

    $high  = $length - 1;
    $lower = 0;

    while ($lower <= $high) {
        $middle = intval(($high + $lower)/2);
        if ($arr[$middle] > $search) {
            $high = $middle -1;
        } elseif ($arr[$middle] < $search) {
            $lower = $middle + 1;
        } else {
            return $middle;
        }
    }

    return false;
}


function binarySearch1($arr, $search)
{
    $length = count($arr);
    $high = $length - 1;
    $lower = 0;

    while ($lower <= $high){
        $mid = intval(($high + $lower)/2);
        if ($arr[$mid] > $search) {
            $high = $mid -1;
        } elseif($arr[$mid] < $search)  {
            $lower = $mid + 1;
        }else {
            return $mid;
        }
    }
    return false;
}


$arr = [1,2,3,4,10,20,66,88];
echo binarySearch1($arr, 20);