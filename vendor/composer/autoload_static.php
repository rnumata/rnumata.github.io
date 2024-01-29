<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb14aaa31eae83e84a08fa8c9e98368f6
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'email_php\\src\\' => 14,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'email_php\\src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb14aaa31eae83e84a08fa8c9e98368f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb14aaa31eae83e84a08fa8c9e98368f6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb14aaa31eae83e84a08fa8c9e98368f6::$classMap;

        }, null, ClassLoader::class);
    }
}
