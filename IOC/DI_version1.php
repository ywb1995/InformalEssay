<?php

/**
 * 依赖注入版本1,对超人的能力限制规定接口，
 */


/**
 * 所有的超人能力模块都要实现的接口
 * Interface SuperModuleInterface
 */
interface SuperModuleInterface
{
    public function active(array $target);
}



class Fight implements SuperModuleInterface
{
    public function active(array $target)
    {

    }
}

class Force implements SuperModuleInterface
{
    public function active(array $target)
    {

    }
}

class Shot implements SuperModuleInterface
{
    public function active(array $target)
    {

    }
}


class Super
{
    public $power;

    public function __construct(SuperModuleInterface $superModule)
    {
        $this->power = $superModule;
    }
}

$force = new Force();

$super = new Super($force);
var_dump($super);