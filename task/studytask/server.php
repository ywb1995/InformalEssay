<?php
/**
 * Created by PhpStorm.
 * User: jmsite.cn
 * Date: 2019/2/20
 * Time: 11:59
 */
set_time_limit(0);
$host = '127.0.0.1';
$port = 8081;
$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die("socket_create() 失败:".socket_strerror(socket_last_error())."\n");
$ret = socket_bind($socket,$host,$port) or die("socket_bind() 失败:".socket_strerror(socket_last_error())."\n");
$ret = socket_listen($socket,10) or die("socket_listen() 失败:".socket_strerror(socket_last_error())."\n");
while (true){
    $connection = socket_accept($socket) or die("socket_accept() 失败:".socket_strerror(socket_last_error())."\n");
    while (true){
        socket_getpeername($connection, $addr, $port);
        $data = socket_read($connection, 4096);
        if (!$data){
            break;
        }
        $msg = date("Y-m-d H:i:s")." {$addr} {$port} 已收到信息(".$data.")";
        echo $msg."\n";
        socket_write($connection, $msg, strlen($msg));
    }
}