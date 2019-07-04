<?php
//获取字符串的最后几位数
function lastStr($n,$str){
    echo substr($str,-$n);
}

//lastStr(4,'HTML!CSS!MySQL!PHP!');

/**
 * substr函数的第三个参数表示从尾部剔除几个字符串
 * 如 substr('abcdefg', 0, -1);  表示剔除g ,然后又因为是从0开始所以返回 abcdef
 * 如 substr('abcdefg', 0, -2);  表示剔除fg ,然后又因为是从0开始所以返回 abcde
 */

