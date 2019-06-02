<?php
/**
 * 简单的IOC容器实现
 */



class Superman
{
    public $power;

    public function __construct(SuperModuleInterface $superModule)
    {
        $this->power = $superModule;
    }
}

interface SuperModuleInterface
{

}

class XPower implements SuperModuleInterface
{

}

/**
 * 容器
 * Class Container
 */
class Container
{
    /**
     * 匿名函数绑定到这里
     * @var array
     */
    protected $binds;

    /**
     * 类的实例绑定到这里
     * @var array
     */
    protected $instances;

    public function bind($abstract, $concrete)
    {
        //如果是匿名函数
        if ($concrete instanceof Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        //将$this 插入$parameters 第一个位置
        array_unshift($parameters, $this);

        //调用$this->binds[$abstract] 函数 $parameters 是函数的参数
        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}


// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂添加超人的生产脚本
$container->bind('superman', function($container, $moduleName) {
    return new Superman($container->make($moduleName));
});



// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('xpower', function($container) {
    return new XPower;
});
$superman_1 = $container->make('superman', ['xpower']);

var_dump($superman_1);die;
/*
// 同上
$container->bind('ultrabomb', function($container) {
    return new UltraBomb;
});

// ****************** 华丽丽的分割线 **********************
// 开始启动生产
$superman_1 = $container->make('superman', 'xpower');
$superman_2 = $container->make('superman', 'ultrabomb');
$superman_3 = $container->make('superman', 'xpower');
// ...随意添加*/
