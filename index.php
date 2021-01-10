<?php

require_once 'src/AutoLoader.php';
AutoLoader::register();

$path = trim( $_SERVER['REQUEST_URI'], '/' );
$path = parse_url( $path, PHP_URL_PATH );

Routing::get( '', 'DefaultController' );
Routing::get( 'search', 'DefaultController' );
Routing::get( 'friends', 'UserController' );
Routing::get( 'profile', 'UserController' );
Routing::get( 'trips', 'TripController' );
Routing::get( 'view', 'TripController' );
Routing::get( 'logout', 'LoginController' );

Routing::get('test', 'DefaultController');

Routing::post( 'create', 'TripController' );
Routing::post( 'login', 'LoginController' );
Routing::post( 'registration', 'LoginController' );
Routing::post( 'planTrip', 'TripController' );
Routing::post('participate', 'TripController');


Routing::post('fetchData', 'AppController');
Routing::ajax( 'fetchPOI', 'TripController' );
Routing::ajax( 'fetchTrips', 'TripController' );
Routing::ajax( 'fetchUsers', 'UserController' );
Routing::ajax( 'fetchComments', 'CommentController');
Routing::run( $path );