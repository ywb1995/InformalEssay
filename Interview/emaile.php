<?php
$mail = 'test@sina.com';  //邮箱地址
$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
echo preg_match($pattern, $mail, $matches);
print_r($matches);
//验证可以使用 filter_var($email, FILTER_VALIDATE_EMAIL)