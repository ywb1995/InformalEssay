<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a799441afcff489838993280522ff50
{
    public static $files = array (
        '54b7ab095f6ed53bba17c9f0a92b797c' => __DIR__ . '/../..' . '/app/Essays/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a799441afcff489838993280522ff50::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a799441afcff489838993280522ff50::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}