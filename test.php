<?php
$str = "%7B%22carrier_driver_name%22%3A%22%E6%9D%A8%E9%9B%AA%E7%90%B4%22%2C%22carrier_driver_phone%22%3A%2214705871666%22%2C%22error_code%22%3A%22%22%2C%22open_order_code%22%3A%222100026661642122075%22%2C%22order_status%22%3A2%2C%22partner_order_code%22%3A%22OID15582387312316%22%2C%22platform_code%22%3A%22%22%2C%22push_time%22%3A1558242485000%7D";
// echo urldecode($str);
// echo '<br>';

// serialize(value)
$a =  unserialize('O:18:"App\Jobs\SendOrder":7:{s:11:"*order_id";i:6097485;s:7:"*type";i:2;s:15:"*logistics_id";i:17;s:10:"connection";N;s:5:"queue";N;s:5:"delay";N;s:6:"*job";N;}');
var_dump($a);
// if (0.00) {
// 		echo '哈哈';
// } else {
// 	echo '来啦';
// }
// var_dump(0.00);
// echo 0.7-0.6;
// echo intval((0.1+0.7)*10); 