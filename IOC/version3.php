<?php

/**
 * 这个版本解耦了超人类和能力类。使得超人类实例化不依赖于多个能力类，而值依赖于能力工厂类
 *
 */


class Fight
{

}

class Force
{

}

class Shot
{

}


/**
 * 创造超人能力的工厂类
 * Class SuperModuleFactory
 */
class SuperModuleFactory
{
    /**
     * 执行此方法创建超人能力模块
     * User: YWB
     * Date: 2019/6/2 0002
     * Time: 10:10
     * @param string $moduleName 能力名称
     * @param array $options 能力的参数
     * @return Fight|Force|Shot
     */
    public function makeModule($moduleName,$options)
    {
        switch ($moduleName) {
            case 'Fight':
                return new Fight($options[0], $options[1]);
            case 'Force':
                return new Force($options[0]);
            case 'Shot':
                return new Shot($options[0], $options[1], $options[2]);
        }
    }
}


class SuperMan
{
    protected $power;

    public function __construct($moduleArr)
    {
        $factory = new SuperModuleFactory();

        foreach ($moduleArr as $moduleName => $options) {
            $this->power[] = $factory->makeModule($moduleName,$options);
        }
    }
}