<?php

require_once 'AutoLoader.php';
AutoLoader::register();

$path = trim( $_SERVER['REQUEST_URI'], '/' );
$path = parse_url( $path, PHP_URL_PATH );

Routing::get( '', 'DefaultController' );
Routing::get( 'search', 'DefaultController' );
Routing::get( 'friends', 'UserController' );
Routing::get( 'settings', 'DefaultController' );
Routing::get( 'trips', 'TripController' );
Routing::get( 'view', 'TripController' );

Routing::get('test', 'DefaultController');

Routing::post( 'create', 'TripController' );
Routing::post( 'login', 'LoginController' );
Routing::post( 'registration', 'LoginController' );

Routing::ajax('ajaxTripDescription', 'TripController');
Routing::ajax('ajaxGetTrips', 'TripController');
Routing::ajax('ajaxGetUsers', 'UserController');
Routing::run( $path );