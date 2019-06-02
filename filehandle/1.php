<?php
/* 此文件用于根据bbe.txt文件对所有单词创建索引，相当于一次预处理 */  
ini_set('display_errors', 'on');
set_time_limit(0);

$src = 'bbe.txt';

function readFilea($path)
{
    $handle = fopen($path, 'r');
    if(!$handle){
        return '请输入一个有效的文件';
    }

    //如果文件到了文件尾部 就返回true 
    while(feof($handle) === false){
        yield fgets($handle);
    }
   fclose($handle);
}

$arr = readFilea($src);
// var_dump($arr);die;
foreach ($arr as $key => $value) {
    # code...
    $lineArr = explode(' ', $value);

    foreach ($lineArr as $k => $v) {
        # code...
        $data = $v.' '.($key+1).','.($k+1);
        // var_dump($data);
        $keys = md5(trim(strtolower($v)));
        if(is_file('./index/'.$keys)){
            file_put_contents('./index/'.$keys, ' '.$data,FILE_APPEND); //追加 
        }else{
            file_put_contents('./index/'.$keys, $data);
        }
    }
}
