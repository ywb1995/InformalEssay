<?php


$db = new PDO('mysql:host=localhost;dbname=test','root','root');

// 获得用户名
$username = 'aaa';
     
$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
   
// 使用bindValue函数
$stmt->bindValue(':username', $username); //使用这个绑定vaule 会吧aaa带进去

 //$stmt->bindParam(':username', $username); //使用这个绑定参数  会把bbb带进去
   
$username = 'bbb';
     
$a = $stmt->execute();
$red = $stmt->fetchAll();

var_dump($red);
