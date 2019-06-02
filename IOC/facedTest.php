<?php

/**
 *实现一个简单的laravel中的门面
 */


/**
 * 实际功能类A
 * Class A
 */
class A
{
    public function  getClassName()
    {
        echo self::class.PHP_EOL;
    }
}

/**
 * 实际功能类B
 * Class B
 */
class B
{
    public function  getClassName()
    {
        echo self::class.PHP_EOL;
    }
}

/**
 * 门面基类
 * Class Facade
 */
abstract class Facade
{

    protected static $objArr = [
        'A' => A::class,
        'B' => B::class,
    ];

    abstract function getClass();

    /**
     * 调用所有不存在的静态方法都会走这个方法,用来实现门面的关键
     * User: YWB
     * Date: 2019/6/2 0002
     * Time: 15:36
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        //self就是写在哪个类里面, 实际调用的就是这个类.
        //static代表使用的这个类, 就是你在父类里写的static,然后被子类覆盖，使用的就是子类的方法或属性
        $class = static::getClass();

        return (new self::$objArr[$class]())->$method($arguments);
    }
}

/**
 * A类的门面类
 * Class AFaced
 */
class AFaced extends Facade
{
    public function getClass()
    {
        return 'A';
    }
}

/**
 * B类的门面类
 * Class BFaced
 */
class BFaced extends Facade
{
    public function getClass()
    {
        return 'B';
    }
}

AFaced::getClassName();
BFaced::getClassName();


