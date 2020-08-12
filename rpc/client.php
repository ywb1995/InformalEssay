<?php
require_once "./vendor/autoload.php";
use \Hprose\Future;
use \Hprose\Socket\Client;
$test = new Client("tcp://127.0.0.1:1314");
$test->fullDuplex = true;
Future\co(function() use ($test) {
    try {
        var_dump((yield $test->hello("yield world1")));
        var_dump((yield $test->hello("yield world2")));
        var_dump((yield $test->hello("yield world3")));
        var_dump((yield $test->hello("yield world4")));
        var_dump((yield $test->hello("yield world5")));
        var_dump((yield $test->hello("yield world6")));
        var_dump(yield $test->helloa());
    }
    catch (\Exception $e) {
        echo ($e);
    }
});
