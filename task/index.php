<?php

//迭代器
function xrange($start, $end, $step = 1)
{
	# code...
	for ($i = $start; $i <= $end; $i += $step) {
		yield $i;
	}	
}

$range = xrange(1,100);
$range->rewind();
$range->next();
echo $range->current();die;
var_dump($range); // object(Generator)#1
var_dump($range instanceof Iterator); // bool(true)
die;
foreach ($range as $v) {
	# code...
	var_dump($v);
}


