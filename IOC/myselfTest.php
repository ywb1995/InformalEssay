<?php

/**
 * 自己写一下version4试试
 */


/**
 * 超人能力的接口
 * Interface SupManPowerInterface
 */
interface SupManPowerInterface
{
    public function active($value);

}

/**
 * 超人打架的能力
 * Class Fight
 */
class Fight implements SupManPowerInterface
{
    /**
     * 能力值
     * @var
     */
    public  $Aggressivity = 0;

    /**
     * 赋值能力值
     * Fight constructor.
     * @param $Aggressivity
     */
    public function __construct($Aggressivity)
    {
        $this->Aggressivity = $Aggressivity;
    }

    public function active($value)
    {
        echo '执行：'.$value;
    }
}

/**
 * 发射X光的能力
 * Class XPower
 */
class XPower implements SupManPowerInterface
{
    /**
     * 能力值
     * @var
     */
    public  $Aggressivity = 0;

    public function __construct($Aggressivity)
    {
        $this->Aggressivity = $Aggressivity;
    }

    public function active($value)
    {
        echo '执行'.$value;
    }
}

class SupMan
{
    /**
     * @var array 超人的能力
     */
    public $power = [];

    /**
     * 增加超人的能力
     * User: YWB
     * Date: 2019/6/2 0002
     * Time: 11:22
     * @param SupManPowerInterface $supManPower
     */
    public function addPower(SupManPowerInterface $supManPower)
    {
        $this->power[] = $supManPower;
    }
}

/**
 * 普通方法加能力
 */
$supMan = new SupMan();

$supMan->addPower(new Fight(100));
$supMan->addPower(new XPower(100));
var_dump($supMan);

/**
 * 使用容器加能力
 */

class Container
{
    /**
     * 绑定匿名函数
     * @var array
     */
    public $binds = [];

    /**
     * 绑定的实例
     * @var array
     */
    public $instances = [];


    public function bind($name, $method)
    {
        if ($method instanceof Closure) {
            $this->binds[$name] = $method;

            return true;
        }

        if (is_object($method)) {
            $this->instances[$name] = $method;
            return true;
        }

        return false;
    }

    /**
     * 执行
     * User: YWB
     * Date: 2019/6/2 0002
     * Time: 11:33
     * @param $name
     * @param array $parameters
     * @return mixed
     */
    public function make($name,$parameters = [])
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$name],$parameters);

    }
}



/**
 * 使用容器加能力
 */

$container = new Container();

// 向该 超级工厂添加超人的生产脚本
$container->bind('supman',function ($container, ...$powerArr){
    $supMan = new SupMan();

    foreach ($powerArr as $v) {
        $supMan->addPower($container->make($v));
    }

    return $supMan;
});



// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('XPower',function (){
    return new XPower(100);
});

$container->bind('Fight',function (){
    return new Fight(100);
});

//生成超人
$sup = $container->make('supman', ['XPower','Fight']);
var_dump($sup);


