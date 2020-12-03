<?php

require 'AutoLoader.php';
spl_autoload_register('AutoLoader::controllerLoader');
spl_autoload_register('AutoLoader::modelLoader');
spl_autoload_register("AutoLoader::defaultLoader");
spl_autoload_register("AutoLoader::repositoryLoader");

    class Routing {
        public static $routes;

        public static function get($url, $controller) {
            self::$routes[$url] = $controller;
        }

        public static function post($url, $controller) {
            self::$routes[$url] = $controller;
        }

        public static function run($url) {
            $action = explode("/", $url)[0];

            if(!array_key_exists($action, self::$routes)) {
                die("Wrong URL!!!");
            }

            $controller = self::$routes[$action];
            $controllerInstance = new $controller;
            $action = $action ?: 'index';

            $controllerInstance->$action();

        }

    }