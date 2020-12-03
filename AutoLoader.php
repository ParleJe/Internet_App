<?php

class AutoLoader
{
    protected static $extension = '.php';
    protected static $top_dir = __DIR__.'/src/';

    public static function controllerLoader ($classname) {
        $directory = self::$top_dir.'controllers/'.$classname.self::$extension;
        if( is_readable($directory)){
            require $directory;
        }
    }

    public static function modelLoader ($classname) {
        $directory = self::$top_dir.'models/'.$classname.self::$extension;
        if( is_readable($directory)){
            require $directory;
        }
    }

    public static function repositoryLoader ($classname) {
        $directory = self::$top_dir.'repository/'.$classname.self::$extension;
        if( is_readable($directory)){
            require $directory;
        }
    }

    public static function defaultLoader ($classname) {
        $directory = __DIR__.$classname.self::$extension;
    }
}