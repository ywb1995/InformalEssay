<?php
/**
 * 常见的设计模式 工厂模式  单例模式  观察者模式 策略模式  适配器模式  装饰器模式
 * 以下是mysql的单列模式
 * Created by PhpStorm.
 * User: YWB
 * Date: 2019/7/2 0002
 * Time: 10:37
 */

class DB{
    private static $instance = null;

    private $error = null;
    private function __construct($host, $username, $password, $dbname)
    {
        try{
            new PDO("mysql:host={$host}dbname={$dbname}", $username, $password);
        }catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public static function getInstance($host, $username, $password, $dbname)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($host, $username, $password, $dbname);
        }

        return self::$instance;
    }

    public function getError()
    {
        return $this->error;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }


    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }
}

$a = DB::getInstance('localhost:3306', 'root', 'root', 'test');
$b = DB::getInstance('localhost:3306', 'root', 'root', 'test');
if ($a->getError()) {
    echo $a->getError();
}
var_dump($a);
var_dump($b);


