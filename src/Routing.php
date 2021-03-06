<?php

    class Routing {
        public static array $routes;
        private static UserSessionHandler $sessionHandler;

        public static function get( $url, $controller ) {
            self::$routes[$url] = $controller;
        }

        public static function post( $url, $controller ) {
            self::$routes[$url] = $controller;
        }


        public static function run( $url ) {

            $action = explode("/", $url)[0];

            if ( ! array_key_exists( $action, self::$routes ) ) {
                die("Wrong URL!!!");
            }

            $sessionHandler = new UserSessionHandler();
            if($sessionHandler->getPageAvailability($action)) {
                $controller = self::$routes[ $action ];
                $controllerInstance = new $controller;
                $action = $action ?: 'index';
                $controllerInstance->$action();
            } else {
                $controllerInstance = new DefaultController();
                $controllerInstance->index();
            }

        }

    }