<?php
//获取字符串的最后几位数
function lastStr($n,$str){
    echo substr($str,-$n);
}

lastStr(4,'HTML!CSS!MySQL!PHP!');

