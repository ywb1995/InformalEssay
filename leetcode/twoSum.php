<?php
class Solution
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    public function twoSum($nums, $target)
    {
        $found = [];
        $count = count($nums);

        for ($i = 0; $i < $count; $i++) {
            $diff = $target - $nums[$i]; //计算差值
            if (array_key_exists($diff, $found)) {
                return [$found[$diff], $i];
            }

            $found[$nums[$i]] = $i;
        }
    }
}
// 记录开始时间
$time_start = microtime(true);
echo $time_start.PHP_EOL;
// 这里放要执行的PHP代码，如:
// echo create_password(6);


$a = new Solution();
$b = $a->twoSum([1,2,3], 5);
var_dump($b);

// 记录结束时间
$time_end = microtime(true);
echo $time_end.PHP_EOL;
// 输出运行总时间
//echo "执行时间 $time seconds";