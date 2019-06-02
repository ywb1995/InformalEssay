<?php

$str = '博客siyuantlw/tlw/sy/俺只是一个打酱油的';
 $str = iconv("UTF-8",'UTF-8',$str);
 $str = urlencode($str);
 echo $str;