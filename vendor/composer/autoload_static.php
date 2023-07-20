<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4a79c8167dabb1c6e9ef22a01750fac
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ren\\Result\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ren\\Result\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4a79c8167dabb1c6e9ef22a01750fac::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4a79c8167dabb1c6e9ef22a01750fac::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd4a79c8167dabb1c6e9ef22a01750fac::$classMap;

        }, null, ClassLoader::class);
    }
}