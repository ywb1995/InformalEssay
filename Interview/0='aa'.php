<?php
$a = [0=>1,'aa'=>2,3,4];

foreach ($a as $key => $value) {
	print_r($key == 'aa' ? 5: $value); //aa和数字比较 ，会转化为0
}