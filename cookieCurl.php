<?php

error_reporting(E_ALL);

ini_set('display_errors','1');

ignore_user_abort();

set_time_limit(0);

$cookie_path='./';

$vars['username']='wang';

$vars['password']='123456';

$method_post=true;

$url='http://ceshi.php.cn/user/usertop_login.asp';

$ch=curl_init();

$params[CURLOPT_URL]=$url;

$params[CURLOPT_HEADER]=0;//是否显示http头信息

$params[CURLOPT_RETURNTRANSFER]=true;

$params[CURLOPT_FOLLOWLOCATION]=0;

$params[CURLOPT_USERAGENT]='Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0';

//$params[CURLOPT_SSL_VERIFYPEER]=false;

//$params[CURLOPT_SSL_VERIFYHOST]=false;

$postfields='';

foreach($vars as $k=>$v){

    $postfields.=urlencode($k).'='.urlencode($v).'&'; 

}

$params[CURLOPT_POST]=true;

$params[CURLOPT_POSTFIELDS]=$postfields;

if(isset($_COOKIE['cookie_jar']) && ($_COOKIE['cookie_jar'] || is_file($_COOKIE['cookie_jar']))){

    $params[CURLOPT_COOKIEFILE]=$_COOKIE['cookie_jar'];

}else{

    $cookie_jar=tempnam($cookie_path,'cookie');//产生一个cookie文件

    $params[CURLOPT_COOKIEJAR]=$cookie_jar;//写入cookie信息

    setcookie('cookie_jar',$cookie_jar);//保存cookie路径

}

curl_setopt_array($ch,$params);

$content=curl_exec($ch);

//var_dump(strip_tags($content));

   

//第二步

$params[CURLOPT_FOLLOWLOCATION]=true;

$nexturl='http://ceshi.php.cn/user/vpsadm2.asp?id=100568&go=c';

$params[CURLOPT_URL]=$nexturl;

$params[CURLOPT_POSTFIELDS]='';

curl_setopt_array($ch,$params);

$content=curl_exec($ch);

sleep(5);

  

//第三步

$nexturl='http://ceshi.php.cn/vpsadm/selfvpsmodifyendtime.asp';

$params[CURLOPT_URL]=$nexturl;

$params[CURLOPT_POSTFIELDS]='year=9001&moneynow=10&id=100568&';

curl_setopt_array($ch,$params);

$content=curl_exec($ch);

echo strip_tags($content);

   

curl_close($ch);