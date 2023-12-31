<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd2e22167f8f473899b5c8a82a1aabf36
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sh3\\Bibliotecas\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sh3\\Bibliotecas\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd2e22167f8f473899b5c8a82a1aabf36::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd2e22167f8f473899b5c8a82a1aabf36::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd2e22167f8f473899b5c8a82a1aabf36::$classMap;

        }, null, ClassLoader::class);
    }
}
