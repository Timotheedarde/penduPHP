<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7426ce11b9f5d6dab214de941d80ad4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7426ce11b9f5d6dab214de941d80ad4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7426ce11b9f5d6dab214de941d80ad4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
