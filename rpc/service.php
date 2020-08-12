<?php
require_once "./vendor/autoload.php";
use Hprose\Socket\Server;

function helloa()
{
    return "ajldal";

}
function hello($name) {
    return "Hello1 $name!";
}



$server = new Server("tcp://0.0.0.0:1314");
$server->setErrorTypes(E_ALL);
$server->setDebugEnabled();
$server->addFunction('hello');
$server->addFunction('helloa');
$server->start();
