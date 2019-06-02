<?php
/**
 * Created by PhpStorm.
 * User: jmsite.cn
 * Date: 2019/2/20
 * Time: 12:22
 */
$host = '127.0.0.1';
$port = 8081;
$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die("socket_create() 失败:".socket_strerror(socket_last_error())."\n");
$ret = socket_connect($socket, $host, $port) or die("socket_connect() 失败:".socket_strerror(socket_last_error())."\n");
$msg = "测试发送信息,pid:".getmypid();
socket_write($socket, $msg, strlen($msg));
$data = socket_read($socket, 4096);
echo "server回复:".$data."\n";
socket_close($socket);