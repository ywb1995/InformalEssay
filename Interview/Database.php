<?php
/**
常用的五种设计模式 单例  工厂 策略 观察者 装饰器
 * 数据库单例模式实现
 */
class Database 
{
	private $db = null; //数据库句柄
	private static $instance = null; //

	private function __construct($config=[])
	{
		# code...
		$dsn = sprintf('mysql:host=%s;dbname=%s',$config['host'],$config['dbname']);
		$this->db = new PDO($dsn,$config['user'],$config['passwork']);
	}

	static public function getInstance($config){
		if(self::$instance === null){
			self::$instance = new Database($config);	
		}
		return self::$instance;
	}

	private function __clone(){}
	private function __wakeup(){}
}


$a = Database::getInstance(['host'=> '127.0.0.1','dbname'=> 'test','user'=>'root','passwork'=>'root']);
$b = Database::getInstance(['host'=> '127.0.0.1','dbname'=> 'test','user'=>'root','passwork'=>'root']);
var_dump($a);

var_dump($b);

