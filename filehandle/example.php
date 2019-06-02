#!/usr/local/bin/php -q  
<?php 
set_time_limit(0);  
$getkey=empty($argv[1]) ? '' : $argv[1]; 
$arr = explode(",",$getkey);   
$len = count($arr); 
if($len > 0){ 
    for($i=0;$i<$len;$i++){
        echo getKey(trim($arr[$i]))."\n"; 
    }
} 
function getKey($key){ 
    $str = "not found [".$key."]"; 
    if($key){ 
        $fc = './index/'.md5($key); 
        $str = file_get_contents($fc); 
    } 
    return $str; 
}

?>