<?php
$user_list = [
    ['name' => '张三', 'age' => 28],
    ['name' => '李四', 'age' => 21],
    ['name' => '王五', 'age' => 20],
    ['name' => '赵六', 'age' => 21]
];
array_multisort(array_column($user_list, 'age'), SORT_DESC, $user_list);

print_r($user_list);