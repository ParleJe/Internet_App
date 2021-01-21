<?php

class AutoLoader
{
    protected static string $extension = '.php';

    protected static array $dirs = [
        __DIR__ .'/controllers/',
        __DIR__ .'/models/',
        __DIR__ .'/repository/',
        __DIR__.'/'
    ];
    public static function allLoader($classname) {
        forEach(self::$dirs as $dir) {
            $wholeDir = $dir.$classname.self::$extension;
            if( is_readable($wholeDir)){
                require $wholeDir;
            }
        }
    }

    public static function register() {
        spl_autoload_register('AutoLoader::allLoader');
    }
}


