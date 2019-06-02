<?php

function logger($fileName) {
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}
 
$logger = logger(__DIR__ . '/log');
echo $logger->send('Foo'); //将Foo传入yield 会吧foo写入文件
echo $logger->send('Bar');//将Bar传入yield 会吧Bar写入文件